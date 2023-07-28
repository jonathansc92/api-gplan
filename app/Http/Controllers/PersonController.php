<?php

namespace App\Http\Controllers;

use App\Http\Filters\PersonFilter;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ResourceCollection;
use App\Http\Services\PersonService;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    protected $service;

    public function __construct(PersonService $service)
    {
        $this->service = $service;
    }

    public function index(PersonFilter $filter): JsonResponse
    {
        $persons = Person::filter($filter)->paginate();

        return success_response(
            data: new ResourceCollection($persons),
            message: __('messages.retrieved', ['model' => __('models/person.plural')])
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        $person = Person::create($request->validated());

        return success_response(
            data: new PersonResource($person),
            message: __('messages.saved', ['model' => __('models/person.singular')]),
            httpStatus: 201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person): JsonResponse
    {
        return $this->service->find($person);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return success_response(
            data: new PersonResource($person),
            message: __('messages.updated', ['model' => __('models/person.singular')])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        Person::destroy($person->id);

        return success_response(
            message: __('messages.deleted', ['model' => __('models/person.singular')])
        );
    }
}
