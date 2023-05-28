<tr class="border-b border-slate-100 dark:border-slate-700  text-slate-500 dark:text-slate-400">
    <td class="p-3">{{$user->id}}</td>
    <td class="p-3">{{$user->name}}</td>
    <td class="p-3">{{$user->email}}</td>
    <td class="p-3">{{$user->role->name}}</td>
    <td class="p-3 flex justify-evenly">
        <form class="py-2.5" method="POST" action="{{ route('users.destroy', $user) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>
        <a class="py-2" href="{{route('users.edit', $user)}}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
            </svg>
        </a>
    </td>

</tr>
