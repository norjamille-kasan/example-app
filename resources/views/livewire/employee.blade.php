<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search..." />
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <x-button x-on:click="$wire.showCreateModal = true">Add Employee</x-button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden ring-1 shadow-sm ring-black/5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Avatar</th>
                                    <th scope="col"
                                        class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Name</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Position</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                                    <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td
                                            class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">
                                            {{ $employee->id }}
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            <x-avatar md :src="Storage::url($employee->avatar)" />
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            {{ $employee->email }}
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            {{ $employee->position }}
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            {{ $employee->phone }}
                                        </td>
                                        <td
                                            class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                            <x-mini-button icon="pencil-square" flat yellow interaction="warning"
                                                wire:click="edit({{ $employee->id }})" />
                                            <x-mini-button icon="trash" flat red interaction="negative"
                                                wire:click="confirmDestroy({{ $employee->id }})" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2">
            {{ $employees->links() }}
        </div>
    </div>
    <form id="create" wire:submit="create">
        <x-modal width="sm:max-w-2xl w-64" wire:model="showCreateModal">
            <x-card title="Add New Employee" class="w-full">
                <div class="space-y-3">
                    <x-input wire:model="createEmployeeForm.first_name" label="First Name" />
                    <x-input wire:model="createEmployeeForm.last_name" label="Last Name" />
                    <x-input wire:model="createEmployeeForm.email" label="Email" type="email" />
                    <x-input wire:model="createEmployeeForm.position" label="Post" />
                    <x-input wire:model="createEmployeeForm.phone" label="Phone" />
                    <x-input wire:model="createEmployeeForm.avatar" label="Avatar" type="file" />
                </div>
                <x-slot name="footer" class="flex justify-end gap-x-4">
                    <x-button type="button" flat label="Cancel" x-on:click="close" />
                    <x-button type="submit" primary label="Add Employee" />
                </x-slot>
            </x-card>
        </x-modal>
    </form>

    <form id="update" wire:submit="update">
        <x-modal width="sm:max-w-2xl w-64" wire:model="showEditModal">
            <x-card title="Edit Employee" class="w-full">
                <div class="space-y-3">
                    <x-input wire:model="editEmployeeForm.first_name" label="First Name" />
                    <x-input wire:model="editEmployeeForm.last_name" label="Last Name" />
                    <x-input wire:model="editEmployeeForm.email" label="Email" type="email" />
                    <x-input wire:model="editEmployeeForm.position" label="Post" />
                    <x-input wire:model="editEmployeeForm.phone" label="Phone" />
                    <x-input wire:model="editEmployeeForm.avatar" label="Avatar" type="file" />
                    @if ($editEmployeeForm->oldAvatarPreview)
                        <x-avatar md :src="Storage::url($editEmployeeForm->oldAvatarPreview)" />
                    @endif
                </div>
                <x-slot name="footer" class="flex justify-end gap-x-4">
                    <x-button type="button" flat label="Cancel" x-on:click="close" />
                    <x-button type="submit" primary label="Add Employee" />
                </x-slot>
            </x-card>
        </x-modal>
    </form>
</div>
