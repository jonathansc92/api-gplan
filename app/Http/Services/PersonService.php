<?php

namespace App\Http\Services;

use App\Http\Filters\PersonFilter;
use App\Http\Requests\StorePersonRequest;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ResourceCollection;
use App\Models\Person;
use Illuminate\Http\Response;

class PersonService
{
    /**
     * Display a listing of the resource.
     */
    public function get(PersonFilter $filter)
    {
        return success_response(
            data: new ResourceCollection(Person::filter($filter)->paginate()),
            message: __('messages.retrieved', ['model' => __('models/person.plural')])
        );
    }

    public function find($person)
    {
        return success_response(
            data: new PersonResource($person),
            message: __('messages.retrieved', ['model' => __('models/person.singular')])
        );
    }

    public function create(StorePersonRequest $request)
    {
        $person = Person::create($request->validated());

        return success_response(
            data: new PersonResource($person),
            message: __('messages.saved', ['model' => __('models/person.singular')]),
            httpStatus: Response::HTTP_CREATED,
        );
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StorePersonRequest $request): JsonResponse
    // {
    //     $person = Person::create($request->validated());

    //     return success_response(
    //         data: new PersonResource($person),
    //         message: __('messages.saved', ['model' => __('models/document-type.singular')]),
    //         httpStatus: 201
    //     );
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Person $person): JsonResponse
    // {
    //     return success_response(
    //         data: new PersonResource($person),
    //         message: __('messages.retrieved', ['model' => __('models/document-type.singular')])
    //     );
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdatePersonRequest $request, Person $person)
    // {
    //     $person->update($request->validated());

    //     return success_response(
    //         data: new PersonResource($person),
    //         message: __('messages.updated', ['model' => __('models/document-type.singular')])
    //     );
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Person $person)
    // {
    //     Person::destroy($person->id);

    //     return success_response(
    //         message: __('messages.deleted', ['model' => __('models/document-type.singular')])
    //     );
    // }
}
