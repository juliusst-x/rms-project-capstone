@extends('layouts.masyarakat')

@section('title')
Dashboard
@endsection
@section('content')
<main class="h-full pb-16 overflow-y-auto">
  {{-- @foreach($liat as $li)
 <li>{{ $li->nik }}</li>
  @endforeach --}}
  <div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
      Welcome Resident {{ auth()->user()->name }}!
    </h2>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }} </li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Total Report
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $pengaduan}}
          </p>
        </div>
      </div>

      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
          <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Not Processed
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $pending }}
          </p>
        </div>
      </div>
      <!-- Card -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Processing
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $process }}
          </p>
        </div>
      </div>
      <!-- Card -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
          <svg class="w-5 h-5" viewBox=" 0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Finished
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $success }}
          </p>
        </div>
      </div>
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
      <!-- Water-level Card -->
      <div class="flex items-center flex-grow max-w-xs p-4 mx-2 mb-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          <i class="fa-solid fa-house-flood-water-circle-arrow-right"></i>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Water-level
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $water_level }}
          </p>
        </div>
      </div>
    
      <!-- Trash-level Card -->
      <div class="flex items-center flex-grow max-w-xs p-4 mx-2 mb-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
          <svg class="w-5 h-5" fill="currentColor" viewBox="2 1 20 20">
            <path fill-rule="evenodd" d="M15 5h-3V4a2 2 0 00-2-2h-2a2 2 0 00-2 2v1H5a1 1 0 00-1 1v1a2 2 0 002 2h1v9a2 2 0 002 2h6a2 2 0 002-2v-9h1a2 2 0 002-2V6a1 1 0 00-1-1zM9 4a1 1 0 011-1h2a1 1 0 011 1v1H9V4zm5 14a1 1 0 01-1 1H7a1 1 0 01-1-1V7h8v11z" clip-rule="evenodd"></path>
        </svg>        
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Trash-level
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $trash_level }}
          </p>
        </div>
      </div>
    </div>

  </div>







  <!-- <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4"> -->
  <!-- Water-level Card -->
  <!-- <div class="flex items-center flex-grow max-w-xs p-4 mx-2 mb-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
        <i class="fa-solid fa-house-flood-water-circle-arrow-right"></i>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Water-level
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">

        </p>
      </div>
    </div> -->

  <!-- Trash-level Card -->
  <!-- <div class="flex items-center flex-grow max-w-xs p-4 mx-2 mb-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
        <svg class="w-5 h-5" fill="currentColor" viewBox="2 1 20 20">
          <path fill-rule="evenodd" d="M15 5h-3V4a2 2 0 00-2-2h-2a2 2 0 00-2 2v1H5a1 1 0 00-1 1v1a2 2 0 002 2h1v9a2 2 0 002 2h6a2 2 0 002-2v-9h1a2 2 0 002-2V6a1 1 0 00-1-1zM9 4a1 1 0 011-1h2a1 1 0 011 1v1H9V4zm5 14a1 1 0 01-1 1H7a1 1 0 01-1-1V7h8v11z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Trash-level
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">

        </p>
      </div>
    </div>
  </div> -->



  {{-- <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="px-4 py-3 mb-8 bg-red-300 rounded-lg shadow-xl border-2 dark:bg-gray-800">
          <label class="block text-sm">
              <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
                  Report Form
              </h2>
              <textarea
                  class="block w-full mt-1 text-sm border-2 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                  rows="8" type="text" placeholder="Fill out your report and include the location clearly"
                  name="description">{{ old('description') }}</textarea>
          </label>

          <label for="image" class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Picture</span>
              <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  type="file" name="image" />
          </label>
          @error('image')
          <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
          @enderror

          <button
              style="width: 100%"
              type="submit"
              class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
              Submit
          </button>
          <button
              style="width: 100%"
              type="button"
              onclick="window.location.href='/'"
              class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-red">
              Back to Homepage
          </button>
      </div>
  </form>  --}}
</main>
@endsection