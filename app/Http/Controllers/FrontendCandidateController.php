<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Currency;
use App\Models\Address;
use App\Models\PhoneNumber;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use DB;
use Session;
use Log;

class FrontendCandidateController extends Controller
{

    public function candidate()
    {
        $owner_id = Session::get('owner_id');
        return view('candidate', compact('owner_id'));
    }
    public function store(Request $request)

    {

        $validator = Validator::make($request->all() , [
        // Validation rules for candidate data...
        'first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100', 'age' => 'required|integer', 'department' => 'required|string|between:2,100', 'min_salary_expectation' => 'required', 'max_salary_expectation' => 'required', 'code' => 'required', 'country' => 'required|string', 'street_address' => 'required|string', 'city' => 'required|string', 'state' => 'required|string', 'postal_code' => 'required|integer', 'type' => 'required', 'number' => 'required', 'school' => 'required|string', 'degree' => 'required|string', 'major' => 'required|string', 'skill' => 'required|string', 'level' => 'required|string', 'company' => 'required|string', 'title' => 'required|string', 'years' => 'required|integer', ]);

      
        if ($validator->fails())
        {
            return response()
                ->json(['Status' => 'fail', 'errors' => $validator->getMessageBag()
                ->toArray() ]);
        }
        // Set Currency data...
        $currency = new Currency();
        $currency->code = $request->code;
        $currency->save();
        // Set Address data...
        $address = new Address();
        $address->country = $request->country;
        $address->street_address = $request->street_address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->postal_code = $request->postal_code;
        $address->save();
        // Set Candidate data...
        $candidate = new Candidate();
        // Set owner_id based on the logged-in user
        $candidate->owner_id = $request->owner_id;
        $candidate->first_name = $request->first_name;
        $candidate->last_name = $request->last_name;
        $candidate->age = $request->age;
        $candidate->department = $request->department;
        $candidate->min_salary_expectation = $request->min_salary_expectation;
        $candidate->max_salary_expectation = $request->max_salary_expectation;
        $candidate->currency_id = $currency->id;
        $candidate->address_id = $address->id;
        $candidate->save();

        // Set PhoneNumber data...
        $phonenumber = new PhoneNumber();
        $phonenumber->candidate_id = $candidate->id;
        $phonenumber->type = $request->type;
        $phonenumber->number = $request->number;
        $phonenumber->save();
        // Set Education data...
        $education = new Education();
        $education->candidate_id = $candidate->id;
        $education->school = $request->school;
        $education->degree = $request->degree;
        $education->major = $request->major;
        $education->save();
        // Set Skill data...
        $skill = new Skill();
        $skill->candidate_id = $candidate->id;
        $skill->skill = $request->skill;
        $skill->level = $request->level;
        $skill->save();
        // Set Experience data...
        $experience = new Experience();
        $experience->candidate_id = $candidate->id;
        $experience->company = $request->company;
        $experience->title = $request->title;
        $experience->years = $request->years;
        $experience->save();

        return response()
            ->json(['message' => 'Candidate created successfully', 'Candidate ID' => $candidate->id], 201);
    }
    function candidates_list(Request $request)
    {
        return Candidate::where('owner_id', $request->query('id'))
            ->get();
    }
    function candidate_view(Request $request)
    {
        $candidate = Candidate::join('currencies', 'currencies.id', '=', 'candidates.currency_id')->join('addresses', 'addresses.id', '=', 'candidates.address_id')
            ->join('phone_numbers', 'phone_numbers.candidate_id', '=', 'candidates.id')
            ->join('skills', 'skills.candidate_id', '=', 'candidates.id')
            ->join('experiences', 'experiences.candidate_id', '=', 'candidates.id')
            ->join('education', 'education.candidate_id', '=', 'candidates.id')
            ->where('candidates.id', '=', $request->id)
            ->get(['candidates.id', 'candidates.first_name', 'candidates.last_name', 'candidates.age', 'candidates.department', 'candidates.min_salary_expectation', 'candidates.max_salary_expectation', 'currencies.code','addresses.country', 'addresses.street_address', 'addresses.city', 'addresses.state', 'addresses.postal_code', 'phone_numbers.type', 'phone_numbers.number', 'education.school', 'education.degree', 'education.major', 'skills.level', 'skills.skill', 'experiences.company', 'experiences.title', 'experiences.years']);
        return $candidate;

    }
    public function candidate_edit(Request $request)
    {
        $validator = Validator::make($request->all() , [
        // Validation rules for candidate data...
        'first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100', 'age' => 'required|integer', 'department' => 'required|string|between:2,100', 'min_salary_expectation' => 'required', 'max_salary_expectation' => 'required', 'code' => 'required', 'country' => 'required|string', 'street_address' => 'required|string', 'city' => 'required|string', 'state' => 'required|string', 'postal_code' => 'required|integer', 'type' => 'required', 'number' => 'required', 'school' => 'required|string', 'degree' => 'required|string', 'major' => 'required|string', 'skill' => 'required|string', 'level' => 'required|string', 'company' => 'required|string', 'title' => 'required|string', 'years' => 'required|integer', ]);

        if ($validator->fails())
        {
            return response()
                ->json(['Status' => 'fail', 'errors' => $validator->getMessageBag()
                ->toArray() ]);
        }
        $candidate = Candidate::findOrFail($request->id);

        // Update the Currency data
        $currency = Currency::findOrFail($candidate->currency_id);
        $currency->update(["code" => $request->code, ]);
        // Update the Address data
        $address = Address::findOrFail($candidate->address_id);
        $address->update(["country" => $request->country, "street_address" => $request->street_address, "city" => $request->city, "state" => $request->state, "postal_code" => $request->postal_code, ]);
        // Update the Candidate data
        $candidate->update(['first_name' => $request->input('first_name') , 'last_name' => $request->input('last_name') , 'age' => $request->input('age') , 'department' => $request->input('department') , ]);
        // Update the PhoneNumber data
        $phonenumber = PhoneNumber::findOrFail($candidate->id);
        $phonenumber->update(["type" => $request->type, "number" => $request->number, ]);
        // Update the Education data
        $education = Education::findOrFail($candidate->id);
        $education->update(["school" => $request->school, "degree" => $request->degree, "major" => $request->major, ]);

        // Update the Skill data
        $skill = Skill::findOrFail($candidate->id);
        $skill->update(["skill" => $request->skill, "level" => $request->level, ]);
     
        // Return a response
        return response()
            ->json(['message' => 'Candidate updated successfully']);
    }
    public function candidate_delete(Request $request)
    {
        $candidate = Candidate::where('id', $request->id)
            ->first();

        if (!$candidate)
        {
            return response()->json(['message' => 'Candidate not found']);
        }
        $candidate = Candidate::find($request->id);
        ////using delete with Laravel eloquent
        Currency::where('id', $candidate->currency_id)
            ->delete();
        Address::where('id', $candidate->address_id)
            ->delete();
        $candidate->delete();
        PhoneNumber::where('candidate_id', $request->id)
            ->delete();
        Education::where('candidate_id', $request->id)
            ->delete();
        Skill::where('candidate_id', $request->id)
            ->delete();
        Experience::where('candidate_id', $request->id)
            ->delete();
        return response()
            ->json(['message' => 'Candidate deleted successfully']);
    }
    public function logout()
    {
        Session::forget('owner_id');
        return redirect('/');

    }

}

