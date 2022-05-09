<section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

    <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
        Update Profile information
    </header>

    <div class="w-full p-6">
        <form method="POST" action="{{ route('user-profile-information.update') }}" class="w-full px-6 py-2 space-y-6 sm:px-10 sm:space-y-8">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap">
                <label for="Name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                    {{ __('Name') }}
                </label>

                <input id="name" type="text"
                    class="form-input w-full @error('email') border-red-500 @enderror" ntype="text" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autofocus autocomplete="name">

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>


            <div class="flex flex-wrap">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                    {{ __('Email') }}
                </label>

                <input id="email" type="email"
                    class="form-input w-full @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autofocus>

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center">
                <h3>Set the daily nutrition limits here:</h3>
                <p class="mt-1">Keep values at '0' for no limit</p>
            </div>

            <div class="flex flex-wrap items-center">
                <label for="calories" class="block text-gray-700 text-sm font-bold mr-4">
                    {{ __('Calories') }}
                </label>

                <input id="calories" type="calories"
                    class="form-input @error('calories') border-red-500 @enderror" type="int" name="calories" value="{{ old('calories') ?? auth()->user()->calories  }}" required autofocus>

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center">
                <label for="carbs" class="block text-gray-700 text-sm font-bold mr-4">
                    {{ __('Carbs') }}
                </label>

                <input id="carbs" type="carbs"
                    class="form-input @error('carbs') border-red-500 @enderror" type="int" name="carbs" value="{{ old('carbs') ?? auth()->user()->carbs }}" required autofocus>

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center">
                <label for="fats" class="block text-gray-700 text-sm font-bold mr-4">
                    {{ __('Fats') }}
                </label>

                <input id="fats" type="fats"
                    class="form-input @error('fats') border-red-500 @enderror" type="int" name="fats" value="{{ old('fatss') ?? auth()->user()->fats }}" required autofocus>

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>
            
            <div class="flex flex-wrap items-center">
                <label for="proteins" class="block text-gray-700 text-sm font-bold mr-4">
                    {{ __('Proteins') }}
                </label>

                <input id="proteins" type="proteins"
                    class="form-input @error('proteins') border-red-500 @enderror" type="int" name="proteins" value="{{ old('proteins') ?? auth()->user()->proteins }}" required autofocus>

                @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>


            <div class="flex flex-wrap">
                <button type="submit">
                {{ __('Update Profile') }}
                </button>
            </div>

        </form>
    </div>
</section>

