<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sr. No.</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University Code</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @php
            $count = 1;
        @endphp
        @foreach($universities as $university)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $count }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $university->university_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $university->university_code }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('edit-university', ['id' => $university->id]) }}"><button class="text-indigo-600 hover:text-indigo-900">
                        Edit
                    </button></a>
                    <button wire:click="delete({{ $university->id }})" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                </td>
            </tr>
            @php
                $count++;
            @endphp
        @endforeach
    </tbody>
    @if ($university_id)
        <livewire:edit-university :key="$university_id" :universityId="$university_id" />
    @endif
    
</table>

