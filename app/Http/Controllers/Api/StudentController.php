<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all users with the type 'student'
        // Replace `user_type_id` with the actual column that denotes user types in your database
        $students = User::where('usertype_id', config('constants.user_types.student'))->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $students,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Define validation rules for the incoming request
        // You may want to add more rules depending on the student fields you have
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        // If validation fails, return errors with a 400 status code
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Create a new User (student) with the validated data and save it to the database
        // `user_type_id` should be set to correspond with the 'student' type in your database
        $student = User::create(array_merge($request->all(), ['usertype_id' => config('constants.user_types.student')]));

        // Return the created student data with a 201 status code for resource creation
        return response()->json([
            'status' => 'success',
            'data' => $student,
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Attempt to find a student by ID
        $student = User::find($id);

        // If a student isn't found, return an error message with a 404 status code
        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Return the student data if it exists
        return response()->json([
            'status' => 'success',
            'data' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Attempt to find a student by ID
        $student = User::find($id);

        // If a student isn't found, return an error message with a 404 status code
        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Validate the incoming request using Laravel's Validator
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            // Include additional validation rules as needed
        ]);

        // If validation fails, return the error messages
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Update the student with validated data
        $student->update($request->all());

        // Return the updated student data
        return response()->json([
            'status' => 'success',
            'data' => $student,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Attempt to find a student by ID
         $student = User::find($id);

         // If a student isn't found, return an error message
         if (!$student) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Student not found.',
             ], Response::HTTP_NOT_FOUND);
         }
 
         // Delete the student
         $student->delete();
 
         // Return a success message after deletion
         return response()->json([
             'status' => 'success',
             'message' => 'Student deleted successfully.',
         ]);
 
    }
}
