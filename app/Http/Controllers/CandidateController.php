<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use Log;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * @OA\Get(
     *     path="/api/v1/candidates/{id}",
     *     summary="Get a specific candidate",
     *     tags={"Candidates"},
     * security={
     *         {"bearer": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the candidate to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             example={
     *                 "data": {
     *                     {
     "id": 1,
     "first_name": "ovi",
     "last_name": "balaji",
     "age": 25,
     "department": "computer",
     "min_salary_expectation": "300000",
     "max_salary_expectation": "600000",
     "code": "USD",
     "street_address": "Chennai,TamilNadu",
     "city": "Madurai",
     "state": "Tamil Nadu",
     "postal_code": "62521",
     "type": "mobile",
     "number": "910101010",
     "school": "Thaai School",
     "degree": "BE",
     "major": "MBA",
     "skill": "Software Developer",
     "company": "Purplematics",
     "title": "Project Lead",
     "years": 5
     },
     *
     *                 },
     *                   }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Candidate not found"
     *     )
     * )
     */
    public function show($id)
    {

        $candidate = Candidate::join('currencies', 'currencies.id', '=', 'candidates.currency_id')->join('addresses', 'addresses.id', '=', 'candidates.address_id')
            ->join('phone_numbers', 'phone_numbers.candidate_id', '=', 'candidates.id')
            ->join('skills', 'skills.candidate_id', '=', 'candidates.id')
            ->join('experiences', 'experiences.candidate_id', '=', 'candidates.id')
            ->join('education', 'education.candidate_id', '=', 'candidates.id')
            ->where('candidates.owner_id', '=', Auth::id())
            ->where('candidates.id', '=', $id)->get(['candidates.first_name', 'candidates.last_name', 'candidates.age', 'candidates.department', 'candidates.min_salary_expectation', 'candidates.max_salary_expectation', 'currencies.code', 'addresses.street_address', 'addresses.city', 'addresses.state', 'addresses.postal_code', 'phone_numbers.type', 'phone_numbers.number', 'education.school', 'education.degree', 'education.major', 'skills.skill', 'experiences.company', 'experiences.title', 'experiences.years']);

        if (!$candidate)
        {
            return response()->json(['message' => $candidate], 404);
        }

        return response()->json(['data' => $candidate], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/v1/candidates",
     *     summary="Get all candidates with pagination",
     *     tags={"Candidates"},
     * security={
     *         {"bearer": {}}
     *     },
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             example={
     *                 "data": {
     *                     {
     "id": 1,
     "first_name": "ovi",
     "last_name": "balaji",
     "age": 25,
     "department": "computer",
     "min_salary_expectation": "300000",
     "max_salary_expectation": "600000",
     "code": "USD",
     "street_address": "Chennai,TamilNadu",
     "city": "Madurai",
     "state": "Tamil Nadu",
     "postal_code": "62521",
     "type": "mobile",
     "number": "910101010",
     "school": "Thaai School",
     "degree": "BE",
     "major": "MBA",
     "skill": "Software Developer",
     "company": "Purplematics",
     "title": "Project Lead",
     "years": 5
     },
     *                                     {
     "id": 2,
     "first_name": "John",
     "last_name": "Cena",
     "age": 40,
     "department": "Tester",
     "min_salary_expectation": "900000",
     "max_salary_expectation": "900000",
     "code": "USD",
     "street_address": "Samuthar,Delhi",
     "city": "Red Fort",
     "state": "Delhi",
     "postal_code": "192033",
     "type": "mobile",
     "number": "9030101010",
     "school": "Gandhi School",
     "degree": "BE",
     "major": "MBA",
     "skill": "Software Tester",
     "company": "TCS",
     "title": "Project Lead",
     "years": 10
     },
     *                 },
     *                 "meta": {
     *                     "current_page": 1,
     *                     "per_page": 10,
     *                     "total": 20
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $candidate = Candidate::join('currencies', 'currencies.id', '=', 'candidates.currency_id')->join('addresses', 'addresses.id', '=', 'candidates.address_id')
            ->join('phone_numbers', 'phone_numbers.candidate_id', '=', 'candidates.id')
            ->join('skills', 'skills.candidate_id', '=', 'candidates.id')
            ->join('experiences', 'experiences.candidate_id', '=', 'candidates.id')
            ->join('education', 'education.candidate_id', '=', 'candidates.id')
            ->where('candidates.owner_id', '=', Auth::id())
            ->select(['candidates.id', 'candidates.first_name', 'candidates.last_name', 'candidates.age', 'candidates.department', 'candidates.min_salary_expectation', 'candidates.max_salary_expectation', 'currencies.code', 'addresses.street_address', 'addresses.city', 'addresses.state', 'addresses.postal_code', 'phone_numbers.type', 'phone_numbers.number', 'education.school', 'education.degree', 'education.major', 'skills.skill', 'experiences.company', 'experiences.title', 'experiences.years'])
            ->paginate(10);

        return response()
            ->json(['data' => $candidate], 200);
    }
    /**
     * @OA\Post(
     *     path="/api/v1/candidates",
     *     summary="Create a new candidate",
     *     tags={"Candidates"},
     *  security={
     *         {"bearer": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="age", type="integer"),
     *             @OA\Property(property="department", type="string"),
     *              @OA\Property(property="min_salary_expectation", type="string"),
     *             @OA\Property(property="max_salary_expectation", type="string"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="country", type="string"),
     *             @OA\Property(property="street_address", type="string"),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="state", type="string"),
     *             @OA\Property(property="postal_code", type="integer"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="school", type="string"),
     *             @OA\Property(property="degree", type="string"),
     *             @OA\Property(property="major", type="string"),
     *             @OA\Property(property="skill", type="string"),
     *             @OA\Property(property="level", type="string"),
     *             @OA\Property(property="company", type="string"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="years", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Candidate created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "message": "Candidate created successfully",
     *                 "Candidate ID": "10"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        log::info('dcmdcdckc');
        $validator = Validator::make($request->all() , [
        // Validation rules for candidate data...
        'first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100', 'age' => 'required|integer', 'department' => 'required|string|between:2,100', 'min_salary_expectation' => 'required', 'max_salary_expectation' => 'required', 'code' => 'required', 'country' => 'required|string', 'street_address' => 'required|string', 'city' => 'required|string', 'state' => 'required|string', 'postal_code' => 'required|integer', 'type' => 'required', 'number' => 'required', 'school' => 'required|string', 'degree' => 'required|string', 'major' => 'required|string', 'skill' => 'required|string', 'level' => 'required|string', 'company' => 'required|string', 'title' => 'required|string', 'years' => 'required', ]);

        if ($validator->fails())
        {
            return response()
                ->json(['errors' => $validator->errors() ], 400);
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
        $candidate->owner_id = Auth::id();
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
    /**
     * @OA\Post(
     *     path="/api/v1/candidates/search",
     *     summary="Search for candidates with pagination",
     *     tags={"Candidates"},
     * security={
     *         {"bearer": {}}
     * },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="keyword", type="string"),
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Candidates search results",
     *         @OA\JsonContent(
     *             example={
     *                 "current_page": 1,
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "first_name": "John",
     *                         "last_name": "Doe",
     *                         "age": 30,
     *                         "department": "IT",
     *                                 "min_salary_expectation": "900000",
     "max_salary_expectation": "900000",
     "code": "USD",
     "country" => 'India',
     "street_address": "Samuthar,Delhi",
     "city": "Red Fort",
     "state": "Delhi",
     "postal_code": "192033",
     "type": "mobile",
     "number": "9030101010",
     "school": "Gandhi School",
     "degree": "BE",
     "major": "MBA",
     "skill": "Software Tester",
     "level" => "MBA",
     "company": "TCS",
     "title": "Project Lead",
     "years": 10
     *
     *
     *                 },
     *                 "links": {
     *                     "first": "http://example.com/api/v1/candidates/search?page=1",
     *                     "last": "http://example.com/api/v1/candidates/search?page=5",
     *                     "prev": null,
     *                     "next": "http://example.com/api/v1/candidates/search?page=2"
     *                 },
     *                 "meta": {
     *                     "current_page": 1,
     *                     "from": 1,
     *                     "last_page": 5,
     *                     "path": "http://example.com/api/v1/candidates/search",
     *                     "per_page": 10,
     *                     "to": 10,
     *                     "total": 50
     *                 }
     *             }
     * }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function search(Request $request)
    {
        $query = Candidate::query();
        ////using the LIKE MySQL keyword and % wildcard character with where clause
        if ($request->has('keyword'))
        {
            $keyword = $request->input('keyword');
            $candidate = Candidate::join('currencies', 'currencies.id', '=', 'candidates.currency_id')->join('addresses', 'addresses.id', '=', 'candidates.address_id')
                ->join('phone_numbers', 'phone_numbers.candidate_id', '=', 'candidates.id')
                ->join('skills', 'skills.candidate_id', '=', 'candidates.id')
                ->join('experiences', 'experiences.candidate_id', '=', 'candidates.id')
                ->join('education', 'education.candidate_id', '=', 'candidates.id')
                ->where('candidates.first_name', 'like', "%$keyword%")->orWhere('candidates.last_name', 'like', "%$keyword%")->orWhere('candidates.age', 'like', "%$keyword%")->orWhere('candidates.department', 'like', "%$keyword%")->orWhere('candidates.min_salary_expectation', 'like', "%$keyword%")->orWhere('candidates.max_salary_expectation', 'like', "%$keyword%")->orWhere('currencies.code', 'like', "%$keyword%")->orWhere('addresses.street_address', 'like', "%$keyword%")->orWhere('addresses.city', 'like', "%$keyword%")->orWhere('addresses.state', 'like', "%$keyword%")->orWhere('addresses.postal_code', 'like', "%$keyword%")->orWhere('phone_numbers.type', 'like', "%$keyword%")->orWhere('phone_numbers.number', 'like', "%$keyword%")->orWhere('education.school', 'like', "%$keyword%")->orWhere('education.degree', 'like', "%$keyword%")->orWhere('education.major', 'like', "%$keyword%")->orWhere('skills.skill', 'like', "%$keyword%")->orWhere('experiences.company', 'like', "%$keyword%")->orWhere('experiences.title', 'like', "%$keyword%")->orWhere('experiences.years', 'like', "%$keyword%")->select(['candidates.id', 'candidates.first_name', 'candidates.last_name', 'candidates.age', 'candidates.department', 'candidates.min_salary_expectation', 'candidates.max_salary_expectation', 'currencies.code', 'addresses.street_address', 'addresses.city', 'addresses.state', 'addresses.postal_code', 'phone_numbers.type', 'phone_numbers.number', 'education.school', 'education.degree', 'education.major', 'skills.skill', 'experiences.company', 'experiences.title', 'experiences.years'])
                ->paginate(10);
        }

        return response()
            ->json($candidate, 200);
    }
    /**
     * @OA\Delete(
     *     path="/api/v1/candidates/{id}",
     *     summary="Delete a specific candidate",
     *     tags={"Candidates"},
     *  security={
     *         {"bearer": {}}
     * },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the candidate to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Candidate deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Candidate not found"
     *     )
     * )
     */

    public function destroy($id)
    {

        $candidate = Candidate::where('id', $id)->where('owner_id', Auth::id())
            ->first();

        if (!$candidate)
        {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        $candidate = Candidate::find($id);
        ////using delete with Laravel eloquent
        Currency::where('id', $candidate->currency_id)
            ->delete();
        Address::where('id', $candidate->address_id)
            ->delete();
        $candidate->delete();
        PhoneNumber::where('candidate_id', $id)->delete();
        Education::where('candidate_id', $id)->delete();
        Skill::where('candidate_id', $id)->delete();
        Experience::where('candidate_id', $id)->delete();
        return response()
            ->json(['message' => 'Candidate deleted successfully'], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/candidates/{id}",
     *     summary="Update a specific candidate",
     *     tags={"Candidates"},
     *  security={
     *         {"bearer": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the candidate to be updated",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="age", type="integer"),
     *             @OA\Property(property="department", type="string"),
     *              @OA\Property(property="min_salary_expectation", type="string"),
     *             @OA\Property(property="max_salary_expectation", type="string"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="country", type="string"),
     *             @OA\Property(property="street_address", type="string"),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="state", type="string"),
     *             @OA\Property(property="postal_code", type="integer"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="school", type="string"),
     *             @OA\Property(property="degree", type="string"),
     *             @OA\Property(property="major", type="string"),
     *             @OA\Property(property="skill", type="string"),
     *             @OA\Property(property="level", type="string"),
     *             @OA\Property(property="company", type="string"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="years", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Candidate updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "message": "Candidate updated successfully",
     *                 "Candidate ID": "10"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate(['first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100', 'age' => 'required|integer', 'department' => 'required|string|between:2,100', 'min_salary_expectation' => 'required', 'code' => 'required', 'country' => 'required|string', 'street_address' => 'required|string', 'city' => 'required|string', 'state' => 'required|string', 'postal_code' => 'required|integer', 'type' => 'required', 'number' => 'required', 'school' => 'required|string', 'degree' => 'required|string', 'major' => 'required|string', 'skill' => 'required|string', 'level' => 'required|string', 'company' => 'required|string', 'title' => 'required|string', 'years' => 'required', ]);
        if ($validator->fails())
        {
            return response()
                ->json(['errors' => $validator->errors() ], 400);
        }
        $candidate = Candidate::findOrFail($id);
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
        // Update the Experience data
        $experience = Experience::findOrFail($candidate->id);
        $experience->update(["candidate_id" => $candidate->id, "company" => $request->company, "title" => $request->title, "years" => $request->years, ]);

        // Return a response
        return response()
            ->json(['message' => 'Candidate updated successfully']);
    }
}

