<x-layouts.admin>
    <h1 class="mb-4">Ajouter Utilisateur</h1>
    
    <form method="POST" action={{ route('admin.users.store') }}>
        @csrf
        <x-form.basic-input name="name" text="Nom"/>
        
        <x-form.basic-input type="email" name="email" text="Email" /> 
        
        <x-form.basic-input type="password" name="password" id="password" text="Mot de passe" />
        
        <x-form.basic-input type="password" name="password_confirm" text="Confirmer le mot de passe" />
        
        <x-form.container error="role">
            <label for="role" class="block">Role</label>
            <select name="role">
                <option>user</option>
                <option>premium</option>
                <option>admin</option>
            </select>
        </x-form.container>

        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>