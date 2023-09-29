<?php

namespace App\Traits;

//use App\Events\MemberRegisteredEvent;
//use App\Models\BenefitRequest;
//use App\Notifications\EmailConfirmationLinkNotification;
//use App\Notifications\MemberRegisteredNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

trait Essentials
{
    /** THis function is used to generate
     * the MemberID of the vendor or stores
     * @return string MemberID
     * @var int length is the length of characters to generate
     * @var string random_character is character generated per loop run
     * @var string gened is final code generated
     *
     * @var string charset is set of accepted characters used in generation
     */
    function generateAdminOrUserId($case = 'admin')
    {
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 7;
        $input_length = strlen($charset);
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_character = $charset[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        $prefix = $case == "user" ? 'UID' : 'AMI';

        return $prefix . $random_string;
    }

    //Create a greeting based on the time of the day
    // public function greet()
    // {
    //     $hour = Carbon::now()->hour;
    //     if ($hour < 12) {
    //         return 'Good morning';
    //     }
    //     if ($hour >= 12 && $hour < 17) {
    //         return 'Good afternoon';
    //     }

    //     return 'Good evening';
    // }

    /** THis function is used to generate
     * the RequestID for benefits
     * charset is set of accepted characters used in generation
     * length is the length of characters to generate
     * random_character is character generated per loop run
     * gened is final code generated
     */
    public function generateAttendanceCode()
    {
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 10;
        $input_length = strlen($charset);
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_character = $charset[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

//     public function saveMultipleImages(array $filesArray, string $folder)
//     {
//         //Work on images here....
//         $files = $filesArray;
//         // dd($files);

//         foreach ($files as $index => $file) {
//             // dd($file);
//             //create random string to use as filename then use it together with the file's extension to save it
//             $basename = Str::random();
//             $actualFileName = $basename . "." . $file->getClientOriginalExtension();

//             //store filename in array to save to database
//             $files[$index] = $folder . '/' . $actualFileName;

//             //now save to folder
//             $file->move(storage_path('app/public/' . $folder), $actualFileName);
//         }

// //        dd(json_encode($files));
//         return json_encode($files);
//     }

//     /**
//      * @param $object
//      * @return array
//      */
//     public function updateMedia($object){
// //        dd($object);

//         //update media for categories
//         if (request()->hasFile('category_picture')) {
//             //check if there is a media for the object and delete the file(s)
//             if (isset($object->category_picture)) {
//                 Storage::disk('public')->delete($object->category_picture);
//             }

//             //upload the new file and return the new media
//             return request()->category_picture->store('categories', 'public');
//         } else {
//             //get the existing file names for the object
//             $oldMedia = json_decode($object->images, true);

//             //process the current selected files, upload them and return an associative array of it
//             $newMedia = json_decode($this->saveMultipleImages(request()->allFiles()), true);

//             //merge the two arrays by updating the old with values from the new
//             $updatedMedia = array_merge($oldMedia, $newMedia);

//             /*
//              * Iterate through each key-value pair in the new media array
//              * If the key exists in the old media array, delete the file at the path specified by the
//              * value in the old media array
//              * */
//             foreach ($newMedia as $key => $value) {
//                 if (array_key_exists($key, $oldMedia)) {
//                     Storage::disk('public')->delete($oldMedia[$key]);
//                 }
//             }

//             //return the new media
//             return $updatedMedia;
//         }
//     }

//     public function generateVerificationLink($member): string
//     {
//         return URL::temporarySignedRoute(
//             'verification.verify',
//             \Illuminate\Support\Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
//             [
//                 'id' => $member->getKey(),
//                 'hash' => sha1($member->getEmailForVerification()),
//             ]
//         );
//     }

// //    public function sendEmailVerificationNotification(): void
// //    {
// //        $member = Auth::user();
// //
// ////        dd($member);
// //
// //        $member->notify(new EmailConfirmationLinkNotification($member));
// //    }

//     //get images in the folder and return them
//     public static function getGalleryImages(): array
//     {
//         $galleryPath = public_path("images/dayout/");

//         return array_diff(scandir($galleryPath), array('.', '..'));
//     }
}
