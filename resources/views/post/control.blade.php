<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Route::getCurrentRoute()->getName() === 'post.create')
                新規登録画面
            @elseif(Route::getCurrentRoute()->getName() === 'post.edit')
                内容修正画面
            @endif
        </h2>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        {{-- <x-message :message="session('message')" /> --}}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            {{-- 新規登録用View --}}
            @if (Route::getCurrentRoute()->getName() === 'post.create')
                <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                            <label for="name" class="font-semibold leading-none mt-4">名前</label>
                            <input type="text" name="name"
                                class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="name"
                                value="{{ old('name') }}" placeholder="名前を入力してください">
                        </div>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="email" class="font-semibold leading-none mt-4">メールアドレス</label>
                        <input type="email" name="email"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="email"
                            value="{{ old('email') }}" placeholder="メールアドレスを入力してください">
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="age" class="font-semibold leading-none mt-4">年齢</label>
                        <input type="number" name="age"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="age"
                            value="{{ old('age') }}" placeholder="年齢を入力してください">
                    </div>

                    <div>
                        <label for="gender" class="font-semibold leading-none mt-4" style="display: block">性別</label>
                        <div style="display: inline-block">
                            <input id="male" type="radio" name="gender" value=0
                            {{ old('gender', 0) == 0 ? 'checked' : '' }}>

                            <label for="male">男性</label>
                        </div>
                        <div class="ps-3" style="display: inline-block">
                            <input id="female" type="radio" name="gender" value=1
                            {{ old('gender') == 1 ? 'checked' : '' }}>
                            <label for="female">女性</label>
                        </div>
                    </div>

                    <x-button class="mt-4 bg-teal-700">
                        登録する
                    </x-button>

                </form>

            {{-- 内容修正用View --}}
            @elseif(Route::getCurrentRoute()->getName() === 'post.edit')
                <form method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                            <label for="name" class="font-semibold leading-none mt-4">名前</label>
                            <input type="text" name="name"
                                class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="name"
                                value="{{ old('name', $post->name) }}" placeholder="名前を入力してください">
                        </div>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="email" class="font-semibold leading-none mt-4">メールアドレス</label>
                        <input type="email" name="email"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="email"
                            value="{{ old('email', $post->email) }}" placeholder="メールアドレスを入力してください">
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="age" class="font-semibold leading-none mt-4">年齢</label>
                        <input type="number" name="age"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="age"
                            value="{{ old('age', $post->age) }}" placeholder="年齢を入力してください">
                    </div>

                    {{-- ↓【覚書】radioボタンでold関数を保持および初期値をチェックする方法
                            old関数の第2引数にDBに保存された値を取り込み、value値と比較する。同じ場合にcheckとすると初期値・old関数共に使用できる --}}

                    <div>
                        <label for="gender" class="font-semibold leading-none mt-4" style="display: block">性別</label>
                        <div style="display: inline-block">
                            <input id="male" type="radio" name="gender" value=0
                            {{ old('gender',$post->gender) == 0 ? 'checked' : '' }}>
                            <label for="male">男性</label>
                        </div>
                        <div class="ps-3" style="display: inline-block">
                            <input id="female" type="radio" name="gender" value=1
                            {{ old('gender',$post->gender) == 1 ? 'checked' : '' }}>
                            <label for="female">女性</label>
                        </div>
                    </div>

                    <x-button class="mt-4 bg-teal-700">
                        修正する
                    </x-button>

                </form>
            @endif

            <a href="/post">
                <x-button class="mt-4">一覧画面に戻る</x-button>
            </a>
        </div>
    </div>
</x-app-layout>
