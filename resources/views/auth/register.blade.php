<x-layout>
    <x-form title="Register an account" description="Start tracking your ideas today">
        <form action="{{ route('register.store') }}" method="POST" class="mt-10 space-y-4">
            @csrf
            {{--<div class="space-y-2">
                <label class="label" for="name">Name</label>
                <input class="input" name="name" placeholder="Your name" required/>
            </div>--}}
            <x-form.field name="name" label="Name"></x-form.field>
            <x-form.field name="email" label="Email"></x-form.field>
            <x-form.field name="password" label="Password"></x-form.field>
            <button type="submit" class="btn mt-2 h-10 w-full">Create a Account</button>
        </form>
    </x-form>
</x-layout>
