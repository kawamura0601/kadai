<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧画面
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="mt-4">
                <table class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <tr>
                            <th class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">ID</th>
                            <th class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">名前</th>
                            <th class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">メールアドレス</th>
                            <th class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">年齢</th>
                            <th class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">性別</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="mt-4 text-gray-600 py-4">{{ $post->id }}</td>
                                <td class="mt-4 text-gray-600 py-4">{{ $post->name }}</td>
                                <td class="mt-4 text-gray-600 py-4">{{ $post->email }}</td>
                                <td class="mt-4 text-gray-600 py-4">{{ $post->age }}</td>
                                <td class="mt-4 text-gray-600 py-4">{{ $gender[$post->gender] }}</td>
                                <td>
                                    <!-- 操作（修正ボタン） -->
                                    <form method="get" action="{{route('post.edit', $post)}}">
                                        <x-button type="submit" class="bg-teal-700">修正</x-button>

                                    </form>
                                </td>
                                <td>
                                    <!-- 操作（削除ボタン） -->
                                    <form method="post" action="{{route('post.destroy', $post)}}">
                                        @csrf
                                        @method('delete')
                                        <x-button class="bg-red-700 ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
