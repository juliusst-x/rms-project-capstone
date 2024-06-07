@extends('layouts.admin')

@section('title')
Detail Concern
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">

        <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
            Detail Concern
        </h2>


        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <div
                    class="text-gray-800 text-sm font-semibold px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 ">

                    <h2>Name: {{$item->name}}</h2>
                    <h2 class="mt-4">Phone Number : {{ $item->phone }}</h2>
                    <h2 class="mt-4">Date : {{ \Carbon\Carbon::parse($item->created_at)->format('l, d F Y - H:i:s') }}
                    </h2>
                    <h2 class="mt-4">Status :
                        @if($item->status == 'Pending')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md dark:text-red-100 dark:bg-red-700">
                                {{ $item->status }}
                            </span>
                        @elseif ($item->status == 'In Process')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-md dark:text-white dark:bg-orange-600">
                                {{ $item->status }}
                            </span>
                        @else
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md dark:bg-green-700 dark:text-green-100">
                                {{ $item->status }}
                            </span>
                        @endif
                    </h2>
                </div>

                <div class="px-4 py-3 mb-8 flex text-gray-800 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="relative hidden mr-3  md:block dark:text-gray-400">
                        <h1 class="text-center mb-8 font-semibold">Picture</h1>
                        <img class=" h-32 w-35 " src="{{ Storage::url($item->image) }}" alt="" loading="lazy" />
                    </div>
                    <div class="text-center flex-1 dark:text-gray-400">
                        <h1 class="mb-8 font-semibold">Description</h1>
                        <p class="text-gray-800 dark:text-gray-400">
                            {{ $item->description}}
                        </p>
                    </div>
                </div>
                <div class="px-4 py-3 mb-8 flex bg-white rounded-lg shadow-md dark:text-gray-400   dark:bg-gray-800">

                    <div class="text-center flex-1">
                        <h1 class="mb-8 font-semibold">Response</h1>
                        <p class="text-gray-800 dark:text-gray-400 select-none pointer-events-none">
                            @if (empty($response->response))
                                No Response
                            @else
                                {{ $response->response}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center my-4">
                <a href="{{ route('export_one_pdf', $item->id)}}"
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Export to PDF
                </a>
            </div>
            <div class="flex justify-center my-6">
                <a href="{{ route('response.view', $item->identifiers)}}"
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Give Response
                </a>
            </div>

            <div class="flex justify-center my-6">
                <a class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                    href="{{ route('admin-concern')}}">back</a>
            </div>
        </div>

</main>
@endsection