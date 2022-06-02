<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の新規作成
        </h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="name" class="font-semibold leading-none mt-4">名前</label>
                        <input type="text" name="name"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="name"
                            placeholder="名前を入力してください">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="email" class="font-semibold leading-none mt-4">メールアドレス</label>
                    <input type="email" name="email"
                        class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="email"
                        placeholder="メールアドレスを入力してください">
                </div>

                <div class="w-full flex flex-col">
                    <label for="age" class="font-semibold leading-none mt-4">年齢</label>
                    <input type="number" name="age"
                        class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="age"
                        placeholder="年齢を入力してください">
                </div>

                <x-button class="mt-4">
                    登録する
                </x-button>

            </form>
        </div>
    </div>
</x-app-layout>
