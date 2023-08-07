<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Candidate;

class CandidatesTest extends TestCase
{

    protected $user;

    public function setUp():
        void
        {
            parent::setUp();

            // Create a user for authentication
            $this->user = User::factory()
                ->create();

            // Generate a bearer token for the user
            $token = auth()->login($this->user);

            // Set the bearer token in the request header
            $this->withHeader('Authorization', 'Bearer ' . $token);
        }

        public function testCreateCandidateWithBearerToken()
        {
            // Simulate a candidate data payload
            $candidateData = ["first_name" => "John", "last_name" => "Doe", "age" => 30, "department" => "IT", "min_salary_expectation" => "900000", "max_salary_expectation" => "900000", "code" => "USD", 'country' => 'India', "street_address" => "Samuthar,Delhi", "city" => "Red Fort", "state" => "Delhi", "postal_code" => "192033", "type" => "mobile", "number" => "9030101010", "school" => "Gandhi School", "degree" => "BE", "major" => "MBA", "skill" => "Software Tester", 'level' => 'MBA', "company" => "TCS", "title" => "Project Lead", "years" => 10];

            // Send a POST request to the store endpoint
            $response = $this->post('/api/v1/candidates', $candidateData);

            // Assert response status code
            $response->assertStatus(201);
            
        }
        public function testGetSpecificCandidateWithBearerToken()
        {
            // Create a candidate instance
            $candidate = Candidate::factory()->create();

            // Send a GET request to the show endpoint
            $response = $this->get('/api/v1/candidates/' . $candidate->id);

            // Assert response status code
            $response->assertStatus(200);
            
        }
        public function testGetAllCandidatesWithPaginationWithBearerToken()
        {
            // Create candidates for testing
            Candidate::factory()
                ->count(5)
                ->create();

            // Send a GET request to the index endpoint with pagination
            $response = $this->get('/api/v1/candidates');

            // Assert response status code
            $response->assertStatus(200);

        }
        public function testSearchCandidatesWithPaginationWithBearerToken()
        {

            $searchData = ['department' => 'IT', 'age' => 30, ];

            // Send a POST request to the search endpoint with pagination
            $response = $this->post('/api/v1/candidates/search', $searchData);

            // Assert response status code
            $response->assertStatus(200);

        }
        public function testDeleteSpecificCandidateWithPaginationWithBearerToken()
        {
            // Create a candidate for testing
            $candidate = Candidate::factory()->create(['owner_id' => $this
                ->user->id]);

            // Send a DELETE request to the delete endpoint
            $response = $this->delete('/api/v1/candidates/' . $candidate->id);

            // Assert response status code
            $response->assertStatus(204);

            // Verify that the candidate is deleted from the database
            $this->assertDatabaseMissing('candidates', ['id' => $candidate->id]);
        }
        public function testUpdateCandidateWithBearerToken()
        {
            // Create a candidate for testing
            $candidate = Candidate::factory()->create(['owner_id' => $this
                ->user->id]);

            // Updated data
            $updatedData = ["first_name" => "John", "last_name" => "Doe", "age" => 30, "department" => "IT", "min_salary_expectation" => "900000", "max_salary_expectation" => "900000", "code" => "USD", 'country' => 'India', "street_address" => "Samuthar,Delhi", "city" => "Red Fort", "state" => "Delhi", "postal_code" => "192033", "type" => "mobile", "number" => "9030101010", "school" => "Gandhi School", "degree" => "BE", "major" => "MBA", "skill" => "Software Tester", 'level' => 'MBA', "company" => "TCS", "title" => "Project Lead", "years" => 10];

            // Send a PUT request to the update endpoint
            $response = $this->put('/v1/candidates/' . $candidate->id, $updatedData);

            // Assert response status code
            $response->assertStatus(200);

            // Verify that the candidate's data is updated in the database
            $this->assertDatabaseHas('candidates', array_merge(['id' => $candidate->id], $updatedData));
        }
    }
    
