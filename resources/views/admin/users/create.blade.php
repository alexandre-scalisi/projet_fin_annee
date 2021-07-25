<x-layouts.admin>
    <x-title class="mb-4">Créer Utilisateur</x-title>
    
    <form method="POST" action={{ route('admin.users.store') }}>
        @csrf
        <x-form.basic-input name="name" text="Nom" :value="old('name')"/>
        
        <x-form.basic-input type="email" name="email" text="Email" :value="old('email')"/> 
        
        <x-form.basic-input type="password" name="password" text="Mot de passe" />
        
        <x-form.basic-input type="password" name="password_confirmation" text="Confirmer le mot de passe" />
        
        <x-form.container error="role">
            <label for="role" class="block">Role</label>
            <select name="role"">
                <option {{ old('role') === "user" ? 'selected' : ''}}>user</option>
                <option {{ old('role') === "premium" ? 'selected' : ''}}>premium</option>
                <option {{ old('role') === "admin" ? 'selected' : ''}}>admin</option>
            </select>
        </x-form.container>

        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>