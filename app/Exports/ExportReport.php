<?php

namespace App\Exports;

use App\Models\UserProfile;
use App\Models\UserAccountDetail;
use App\Models\TicketBooking;
use App\Models\HotelBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportReport implements FromCollection, WithHeadings, WithMapping
{
    protected $requestPayload;

    public function __construct(array $requestPayload)
    {
        $this->requestPayload = $requestPayload;
    }

    public function collection()
    {
        $data = collect();
        // dd($data);

        $userProfiles = UserProfile::with([
            'category', 'artistType', 'user', 'project', 'festival', 'PACountry', 'PAState', 'PACity', 'curator'
        ])->select(
            'id', 'name', 'email', 'user_id', 'project_year', 'festival_id', 'category_id', 'artist_type_id', 
            'curator_id', 'country_code', 'contact', 'dob', 'permanent_address', 'city_id', 'state_id', 'country_id', 
            'pincode', 'company_collective', 'stage_name', 'artist_bio', 'facebook_url', 'instagram_url', 
            'linkdin_url', 'twitter_url', 'website', 'practice_image_1', 'practice_credit_1', 'practice_image_2', 
            'practice_credit_2', 'practice_image_3', 'practice_credit_3', 'profile_image_1', 'profile_credit_1', 
            'profile_image_2', 'profile_credit_2', 'other_link', 'has_serendipity_arts', 'year'
        )->get();

        foreach ($userProfiles as $profile) {
            $practiceUrl1 = $profile->practice_image_1 ? asset('uploads/users/'.$profile->practice_image_1) : 'N/A';
            $practiceUrl2 = $profile->practice_image_2 ? asset('uploads/users/'.$profile->practice_image_2) : 'N/A';
            $practiceUrl3 = $profile->practice_image_3 ? asset('uploads/users/'.$profile->practice_image_3) : 'N/A';
            $profileUrl1  = $profile->profile_image_1 ? asset('uploads/users/'.$profile->profile_image_1) : 'N/A';
            $profileUrl2  = $profile->profile_image_2 ? asset('uploads/users/'.$profile->profile_image_2) : 'N/A';
            $baseUserData = [
                'name' => $profile->name ?? 'N/A',
                'email' => $profile->email ?? 'N/A',
                'user_type' => $profile->user->frontendRole->name ?? 'N/A',
                'project_year' => $profile->project_year ?? 'N/A',
                'festival' => $profile->festival->name ?? 'N/A',
                'category' => $profile->category->name ?? 'N/A',
                'artist_type' => $profile->artistType->name ?? 'N/A',
                'curator' => $profile->curator->name ?? 'N/A',
                'country_code' => $profile->country_code ?? 'N/A',
                'contact' => $profile->contact ?? 'N/A',
                'dob' => $profile->dob ?? 'N/A',
                'permanent_address' => $profile->permanent_address ?? 'N/A',
                'country' => $profile->PACountry->country_name ?? 'N/A',
                'state' => $profile->PAState->state_name ?? 'N/A',
                'city' => $profile->PACity->city_name ?? 'N/A',
                'pincode' => $profile->pincode ?? 'N/A',
                'stage_name' => $profile->stage_name ?? 'N/A',
                'artist_bio' => $profile->artist_bio ?? 'N/A',
                'facebook_url' => $profile->facebook_url ?? 'N/A',
                'instagram_url' => $profile->instagram_url ?? 'N/A',
                'linkdin_url' => $profile->linkdin_url ?? 'N/A',
                'twitter_url' => $profile->twitter_url ?? 'N/A',
                'website' => $profile->website ?? 'N/A',
                'practice_image_1' => $practiceUrl1 !== 'N/A' ? '=HYPERLINK("'.$practiceUrl1.'", "Practice Image 1")' : 'N/A',
                'practice_credit_1' => $profile->practice_credit_1 ?? 'N/A',
                'practice_image_2' => $practiceUrl2 !== 'N/A' ? '=HYPERLINK("'.$practiceUrl2.'", "Practice Image 2")' : 'N/A',
                'practice_credit_2' => $profile->practice_credit_2 ?? 'N/A',
                'practice_image_3' => $practiceUrl3 !== 'N/A' ? '=HYPERLINK("'.$practiceUrl3.'", "Practice Image 3")' : 'N/A',
                'practice_credit_3' => $profile->practice_credit_3 ?? 'N/A',
                'profile_image_1' => $profileUrl1 !== 'N/A' ? '=HYPERLINK("'.$profileUrl1.'", "Profile Image 1")' : 'N/A',
                'profile_credit_1' => $profile->profile_credit_1 ?? 'N/A',
                'profile_image_2' => $profileUrl2 !== 'N/A' ? '=HYPERLINK("'.$profileUrl2.'", "Profile Image 2")' : 'N/A',
                'profile_credit_2' => $profile->profile_credit_2 ?? 'N/A',
                'other_link' => $profile->other_link ?? 'N/A',
                'has_serendipity_arts' => $profile->has_serendipity_arts ?? 'N/A',
                'year' => implode(', ', $profile->year) ?? 'N/A',
                'company_collective' => $profile->company_collective ?? 'N/A',
                'account_number' => '',
                'bank_holder_name' => '',
                'bank_name' => '',
                'branch_address' => '',
                'ifsc_code' => '',
                'residency' => '',
                'swift_code' => '',
                'iban_number' => '',
                'corresponding_bank_details' => '',
                'cancel_cheque_image' => '',
                'pancard_number' => '',
                'pancard_link_with_adhar' => '',
                'pancard_image' => '',
                'has_gst_applicable' => '',
                'gst_number' => '',
                'gst_certificate_file' => '',
                'banking_status' => '',
                'onward_date' => '',
                'return_date' => '',
                'occupant' => '',
                'check_in_date' => '',
                'check_out_date' => ''
            ];

            if (isset($this->requestPayload['banking_details'])) {
                $bank = UserAccountDetail::where('profile_id', $profile->id)
                    ->select('account_number', 'bank_holder_name', 'bank_name', 'branch_address', 'ifsc_code', 'residency', 
                             'swift_code', 'iban_number', 'corresponding_bank_details', 'cancel_cheque_image', 
                             'pancard_number', 'pancard_link_with_adhar', 'pancard_image', 'has_gst_applicable', 
                             'gst_number', 'gst_certificate_file', 'banking_status')
                    ->first();

                $bankingStatusMap = [
                    1 => 'PENDING',
                    2 => 'IN REVIEW',
                    3 => 'FREEZE',
                ];

                if ($bank) {
                    $chequeUrl = $bank->cancel_cheque_image ? asset('uploads/users/' . $bank->cancel_cheque_image) : 'N/A';
                    $pancardUrl = $bank->pancard_image ? asset('uploads/users/' . $bank->pancard_image) : 'N/A';
                    $gstUrl = $bank->gst_certificate_file ? asset('uploads/users/' . $bank->gst_certificate_file) : 'N/A';

                    $baseUserData['account_number'] = $bank->account_number ?? 'N/A';
                    $baseUserData['bank_holder_name'] = $bank->bank_holder_name ?? 'N/A';
                    $baseUserData['bank_name'] = $bank->bank_name ?? 'N/A';
                    $baseUserData['branch_address'] = $bank->branch_address ?? 'N/A';
                    $baseUserData['ifsc_code'] = $bank->ifsc_code ?? 'N/A';
                    $baseUserData['residency'] = $bank->residency ?? 'N/A';
                    $baseUserData['swift_code'] = $bank->swift_code ?? 'N/A';
                    $baseUserData['iban_number'] = $bank->iban_number ?? 'N/A';
                    $baseUserData['corresponding_bank_details'] = $bank->corresponding_bank_details ?? 'N/A';
                    $baseUserData['pancard_number'] = $bank->pancard_number ?? 'N/A';
                    $baseUserData['cancel_cheque_image'] = $chequeUrl !== 'N/A' ? '=HYPERLINK("'.$chequeUrl.'", "Cancel Cheque Image")' : 'N/A';
                    $baseUserData['pancard_link_with_adhar'] = $bank->pancard_link_with_adhar ?? 'N/A';
                    $baseUserData['pancard_image'] = $pancardUrl !== 'N/A' ? '=HYPERLINK("'.$pancardUrl.'", "Pancard Image")' : 'N/A';
                    $baseUserData['has_gst_applicable'] = $bank->has_gst_applicable ?? 'N/A';
                    $baseUserData['gst_number'] = $bank->gst_number ?? 'N/A';
                    $baseUserData['gst_certificate_file'] = $gstUrl !== 'N/A' ? '=HYPERLINK("'.$gstUrl.'", "GST Certificate File")' : 'N/A';
                    $baseUserData['banking_status'] = $bankingStatusMap[$bank->banking_status] ?? 'N/A';
                }
            }

            $data->push($baseUserData);
            // dd($data);

            $ticketBookings = TicketBooking::where('profile_id', $profile->id)->get();
            if ($ticketBookings->count()) {
                foreach ($ticketBookings as $ticket) {
                    $data->push([
                        'name' => '',
                        'email' => '',
                        'user_type' => '',
                        'project_year' => '',
                        'festival' => '',
                        'category' => '',
                        'artist_type' => '',
                        'curator' => '',
                        'country_code' => '',
                        'contact' => '',
                        'dob' => '',
                        'permanent_address' => '',
                        'country' => '',
                        'state' => '',
                        'city' => '',
                        'pincode' => '',
                        'stage_name' => '',
                        'artist_bio' => '',
                        'facebook_url' => '',
                        'instagram_url' => '',
                        'linkdin_url' => '',
                        'twitter_url' => '',
                        'website' => '',
                        'practice_image_1' => '',
                        'practice_credit_1' => '',
                        'practice_image_2' => '',
                        'practice_credit_2' => '',
                        'practice_image_3' => '',
                        'practice_credit_3' => '',
                        'profile_image_1' => '',
                        'profile_credit_1' => '',
                        'profile_image_2' => '',
                        'profile_credit_2' => '',
                        'other_link' => '',
                        'has_serendipity_arts' => '',
                        'year' => '',
                        'company_collective' => '',
                        'account_number' => '',
                        'bank_holder_name' => '',
                        'bank_name' => '',
                        'branch_address' => '',
                        'ifsc_code' => '',
                        'residency' => '',
                        'swift_code' => '',
                        'iban_number' => '',
                        'corresponding_bank_details' => '',
                        'cancel_cheque_image' => '',
                        'pancard_number' => '',
                        'pancard_link_with_adhar' => '',
                        'pancard_image' => '',
                        'has_gst_applicable' => '',
                        'gst_number' => '',
                        'gst_certificate_file' => '',
                        'banking_status' => '',
                        'onward_date' => $ticket->onward_date ?? 'N/A',
                        'return_date' => $ticket->return_date ?? 'N/A',
                        'occupant' => $ticket->occupant ?? 'N/A',
                        'check_in_date' => '',
                        'check_out_date' => ''
                    ]);
                }
            }

            $hotelBookings = HotelBooking::where('profile_id', $profile->id)->get();
            if ($hotelBookings->count()) {
                foreach ($hotelBookings as $hotel) {
                    $data->push([
                        'name' => '',
                        'email' => '',
                        'user_type' => '',
                        'project_year' => '',
                        'festival' => '',
                        'category' => '',
                        'artist_type' => '',
                        'curator' => '',
                        'country_code' => '',
                        'contact' => '',
                        'dob' => '',
                        'permanent_address' => '',
                        'country' => '',
                        'state' => '',
                        'city' => '',
                        'pincode' => '',
                        'stage_name' => '',
                        'artist_bio' => '',
                        'facebook_url' => '',
                        'instagram_url' => '',
                        'linkdin_url' => '',
                        'twitter_url' => '',
                        'website' => '',
                        'practice_image_1' => '',
                        'practice_credit_1' => '',
                        'practice_image_2' => '',
                        'practice_credit_2' => '',
                        'practice_image_3' => '',
                        'practice_credit_3' => '',
                        'profile_image_1' => '',
                        'profile_credit_1' => '',
                        'profile_image_2' => '',
                        'profile_credit_2' => '',
                        'other_link' => '',
                        'has_serendipity_arts' => '',
                        'year' => '',
                        'company_collective' => '',
                        'account_number' => '',
                        'bank_holder_name' => '',
                        'bank_name' => '',
                        'branch_address' => '',
                        'ifsc_code' => '',
                        'residency' => '',
                        'swift_code' => '',
                        'iban_number' => '',
                        'corresponding_bank_details' => '',
                        'cancel_cheque_image' => '',
                        'pancard_number' => '',
                        'pancard_link_with_adhar' => '',
                        'pancard_image' => '',
                        'has_gst_applicable' => '',
                        'gst_number' => '',
                        'gst_certificate_file' => '',
                        'banking_status' => '',
                        'onward_date' => '',
                        'return_date' => '',
                        'occupant' => '',
                        'check_in_date' => $hotel->check_in_date ?? 'N/A',
                        'check_out_date' => $hotel->check_out_date ?? 'N/A'
                    ]);
                }
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Name', 'Email', 'User Type', 'Project Year', 'Festival', 'Category', 'Artist Type', 'Curator', 
            'Country Code', 'Contact', 'DOB', 'Permanent Address', 'Country', 'State', 'City', 'Pincode', 
            'Stage Name', 'Artist Bio', 'Facebook URL', 'Instagram URL', 'LinkedIn URL', 'Twitter URL', 
            'Website', 'Practice Image 1', 'Practice Credit 1', 'Practice Image 2', 'Practice Credit 2', 
            'Practice Image 3', 'Practice Credit 3', 'Profile Image 1', 'Profile Credit 1', 'Profile Image 2', 
            'Profile Credit 2', 'Other Link', 'Has Serendipity Arts', 'Year', 'Company Collective', 
            'Account Number', 'Bank Holder Name', 'Bank Name', 'Branch Address', 'IFSC Code', 'Residency', 
            'SWIFT Code', 'IBAN Number', 'Corresponding Bank Details', 'Cancel Cheque Image', 'Pancard Number', 
            'Pancard Link with Aadhar', 'Pancard Image', 'Has GST Applicable', 'GST Number', 
            'GST Certificate File', 'Banking Status', 'Onward Date', 'Return Date', 'Occupant', 
            'Check-In Date', 'Check-Out Date'
        ];
    }

    public function map($row): array
    {
        return $row;
    }
}
