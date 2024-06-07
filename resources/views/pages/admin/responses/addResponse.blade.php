@extends('layouts.admin')

@section('title')
Response
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
            Give Response
        </h2>
        <form action="{{ route('response.create', $concern->identifiers)}} " method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $concern->identifiers }} ">
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Response</span>
                    <textarea
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                        rows="8" type="text" placeholder="Give response" value="{{ old('description')}}" name="response"
                        required></textarea>
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Status</span>

                    <select
                        class="block w-full text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                        name="status" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="In Process">In Process</option>
                        <option value="Done">Done</option>
                    </select>
                </label>
                <button type="submit"
                    class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Submit
                </button>
            </div>
        </form>
    </div>
</main>
@endsection