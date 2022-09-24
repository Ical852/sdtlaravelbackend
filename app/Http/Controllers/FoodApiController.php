<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Food;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodApiController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $foods = Food::all();
            return ResponseFormatter::success($foods, 'Success Get All Food');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Get Food Failed', 500);
        }
    }

    public function getById(Request $request, $id)
    {
        try {
            $foods = Food::where('id', $id)->first();
            return ResponseFormatter::success($foods, 'Success Get Food');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Get Food Failed', 500);
        }
    }


    public function create(Request $request)
    {
        try {
            $validator =  Validator::make($request->all() ,[
                'name' => ['required', 'min:3', 'max:255'],
                'description' => ['required', 'min:3'],
                'ingredients' => ['required'],
                'price' => ['required', 'numeric'],
                'rate' => ['required'],
                'types' => ['required'],
                'picture_path' => ['required', 'image']
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(null, $validator->errors());
            }


            if ($request->file('picture_path')) {
                $picture_path = $request->picture_path->store('assets/food', 'public');

                $food = Food::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'ingredients' => $request->ingredients,
                    'price' => $request->price,
                    'rate' => $request->rate,
                    'types' => $request->types,
                    'picture_path' => $picture_path
                ]);

                return ResponseFormatter::success($food, 'Food successfully created');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Something Went Wrong',
                    'error' => 'Failed Create Food'
                ], 'Failed Create Food', 500);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Create Food Failed', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $food = Food::where('id', $id)->first();
        $food->update($data);

        return ResponseFormatter::success($food, 'Food Updated');
    }

    public function updatepic(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'picture_path' => ['required', 'image']
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                ['error' => $validator->errors()],
                'Update Food Photo Failed',
                401
            );
        }

        $food = Food::where('id', $id)->first();
        if ($request->file('picture_path')) {
            $image = $request->picture_path->store('assets/food', 'public');

            $food->picture_path = $image;
            $food->update();

            return ResponseFormatter::success($food, 'Food Photo successfully updated');
        } else {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => 'Failed'
            ], 'Update Food Photo Failed', 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $food = Food::where('id', $id)->first();
            if (!$food) {
               return ResponseFormatter::error([
                    'message' => 'Something Went Wrong',
                    'error' => 'Food Not Found'
                ], 'Delete Food Failed', 500);
            }
            $food->delete();
            return ResponseFormatter::success($food, 'Food successfully deleted');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Delete Food Failed', 500);
        }
    }

}
