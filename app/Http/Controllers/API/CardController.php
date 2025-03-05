<?php

namespace App\Http\Controllers\API;

use Log;
use App\Models\Carte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardController extends Controller
{
    /**
     * Retourne les cartes spécifiques à un utilisateur authentifié.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth()->user();
        $cartes = $user->cartes;
        return response()->json([
            'status' => 200,
            'cartes' => $cartes,
        ]);
    }

    /**
     * Retourne toutes les cartes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $cartes = Carte::all();
        return response()->json([
            'status' => 200,
            'cartes' => $cartes,
        ]);
    }

    /**
     * Ajoute une nouvelle carte.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'nullable',
            'adress' => 'nullable',
            'phone' => 'nullable',
            'title' => 'nullable',
            'company' => 'nullable',
            'website' => 'nullable',
            'facebook' => 'nullable|url',
            'linkdin' => 'nullable|url',
            'whatsapp' => 'nullable|numeric',
            'logo' => 'nullable|image',
            'photo' => 'nullable|image',
            'background_image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        } else {
            $carte = new Carte;

            $carte->first_name = $request->input('first_name');
            $carte->last_name = $request->input('last_name');
            $carte->email = $request->input('email');
            $carte->adress = $request->input('adress');
            $carte->phone = $request->input('phone');
            $carte->title = $request->input('title');
            $carte->company = $request->input('company');
            $carte->website = $request->input('website');
            $carte->facebook = $request->input('facebook');
            $carte->linkdin = $request->input('linkdin');
            $carte->whatsapp = $request->input('whatsapp');
            $carte->user_id = auth()->id();  // Associe la carte à l'utilisateur authentifié

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->logo = 'storage/' . $path;
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->photo = 'storage/' . $path;
            }

            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->background_image = 'storage/' . $path;
            }

            $carte->save();

            // Générer l'URL de la carte à encoder dans le QR code après avoir sauvegardé la carte
            $qrCodeData = route('cartes.show', ['id' => $carte->id]);
            $qrCode = QrCode::format('svg')->size(200)->generate($qrCodeData);
            $fileName = time() . '.svg';
            $filePath = public_path('qrcodes/' . $fileName);
            file_put_contents($filePath, $qrCode);

            $carte->qr_code = 'qrcodes/' . $fileName;
            $carte->save();

            return response()->json([
                'status' => 200,
                'carte' => $carte,
                'message' => 'Carte ajoutée avec succès'
            ]);
        }
    }

    /**
     * Affiche une carte spécifique.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $carte = Carte::find($id);

        if (!$carte) {
            return response()->json(['message' => 'Carte non trouvée'], 404);
        }

        return response()->json([
            'status' => 200,
            'carte' => $carte
        ]);
    }

    /**
     * Imprime une carte spécifique.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    
    //  public function print($id)
    //  {
    //      ini_set('memory_limit', '512M'); // Augmenter la limite de mémoire
    //      $carte = Carte::find($id);
     
    //      if (!$carte) {
    //          return response()->json(['message' => 'Carte non trouvée'], 404);
    //      }
     
    //      $carte->photo = $this->getBase64Image(public_path($carte->photo));
    //      $carte->logo = $this->getBase64Image(public_path($carte->logo));
    //      $carte->qr_code = $this->getBase64Image(public_path($carte->qr_code));
    //      $carte->background_image = $this->getBase64Image(public_path($carte->background_image));
     
    //      ini_set('max_execution_time', '3600');
     
    //      $pdf = \PDF::loadView('cartes.print', compact('carte'))->setPaper([0, 0, 200.60, 170.98], 'landscape');
     
    //      return $pdf->download('carte.pdf');
    //  }

    /**
 * Imprime une carte spécifique.
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
public function print($id)
{
    ini_set('memory_limit', '512M'); // Augmenter la limite de mémoire
    $carte = Carte::find($id);

    if (!$carte) {
        return response()->json(['message' => 'Carte non trouvée'], 404);
    }

    $carte->photo = $this->getBase64Image(public_path($carte->photo));
    $carte->logo = $this->getBase64Image(public_path($carte->logo));
    $carte->qr_code = $this->getBase64Image(public_path($carte->qr_code));
    $carte->background_image = $this->getBase64Image(public_path($carte->background_image));

    ini_set('max_execution_time', '3600');
    $pdf = \PDF::loadView('cartes.print', compact('carte'))
                ->setPaper([0, 0, 187.72, 305.72], 'landscape'); // Dimensions en points pour une carte de visite (85mm x 55mm environ, 1mm = 2.83465 points)

    return $pdf->download('carte.pdf');
}



     

    // public function print($id)
    // {
    //     ini_set('memory_limit', '512M'); // Augmenter la limite de mémoire
    //     $carte = Carte::find($id);

    //     if (!$carte) {
    //         return response()->json(['message' => 'Carte non trouvée'], 404);
    //     }

    //     $carte->photo = $this->getBase64Image(public_path($carte->photo));
    //     $carte->logo = $this->getBase64Image(public_path($carte->logo));
    //     $carte->qr_code = $this->getBase64Image(public_path($carte->qr_code));
    //     $carte->background_image = $this->getBase64Image(public_path($carte->background_image));

    //     ini_set('max_execution_time', '3600');
    //     $pdf = \PDF::loadView('cartes.print', compact('carte'));

    //     return $pdf->download('carte.pdf');
    // }

    /**
     * Modifie une carte existante.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'nullable',
            'adress' => 'nullable',
            'phone' => 'nullable',
            'title' => 'nullable',
            'company' => 'nullable',
            'website' => 'nullable',
            'facebook' => 'nullable|url',
            'linkdin' => 'nullable|url',
            'whatsapp' => 'nullable|numeric',
            'logo' => 'nullable|image',
            'photo' => 'nullable|image',
            'background_image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        } else {
            $carte = Carte::find($id);
            if (!$carte) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Carte non trouvée'
                ]);
            }

            $carte->first_name = $request->input('first_name');
            $carte->last_name = $request->input('last_name');
            $carte->email = $request->input('email');
            $carte->adress = $request->input('adress');
            $carte->phone = $request->input('phone');
            $carte->title = $request->input('title');
            $carte->company = $request->input('company');
            $carte->website = $request->input('website');
            $carte->facebook = $request->input('facebook');
            $carte->linkdin = $request->input('linkdin');
            $carte->whatsapp = $request->input('whatsapp');

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->logo = 'storage/' . $path;
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->photo = 'storage/' . $path;
            }

            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/carte', $filename, 'public');
                $carte->background_image = 'storage/' . $path;
            }

            $carte->save();

            // Générer l'URL de la carte à encoder dans le QR code après avoir sauvegardé la carte
            $qrCodeData = route('cartes.show', ['id' => $carte->id]);
            $qrCode = QrCode::format('svg')->size(200)->generate($qrCodeData);
            $fileName = time() . '.svg';
            $filePath = public_path('qrcodes/' . $fileName);
            file_put_contents($filePath, $qrCode);

            $carte->qr_code = 'qrcodes/' . $fileName;
            $carte->save();

            return response()->json([
                'status' => 200,
                'carte' => $carte,
                'message' => 'Carte modifiée avec succès'
            ]);
        }
    }

    /**
     * Supprime une carte spécifique.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $carte = Carte::find($id);

        if (!$carte) {
            return response()->json(['message' => 'Carte non trouvée'], 404);
        }

        // Supprimer les fichiers associés (logo, photo, background_image, qr_code)
        if ($carte->logo && file_exists(public_path($carte->logo))) {
            unlink(public_path($carte->logo));
        }

        if ($carte->photo && file_exists(public_path($carte->photo))) {
            unlink(public_path($carte->photo));
        }

        if ($carte->background_image && file_exists(public_path($carte->background_image))) {
            unlink(public_path($carte->background_image));
        }

        if ($carte->qr_code && file_exists(public_path($carte->qr_code))) {
            unlink(public_path($carte->qr_code));
        }

        // Supprimer la carte
        $carte->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Carte supprimée avec succès'
        ]);
    }

    /**
     * Convertit une image en base64.
     *
     * @param string $path
     * @return string|null
     */
    private function getBase64Image($path)
    {
        try {
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                return 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la lecture du fichier : ' . $e->getMessage());
        }

        return null;
    }
}
