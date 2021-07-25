<x-layouts.admin>
    <x-title class="mb-4">Modifier utilisateur</x-title>
    
    <form method="POST" action={{ route('admin.users.update', $user->id) }}>
        @csrf
        @method('PUT')
        <x-form.basic-input name="name" text="Nom" :value="$user->name"/>
            
        <x-form.basic-input type="email" name="email" text="Email" :value="$user->email"/> 
                
        <x-form.basic-input type="password" name="current_password" text="Mot de passe actuel"/>

        <x-form.basic-input type="password" name="password" text="Nouveau mot de passe"/>
        
        <x-form.basic-input type="password" name="password_confirmation" text="Confirmer nouveau mot de passe" />
            
        
        
        <x-form.container error="role">
            <label for="role" class="block">Role</label>
            <select name="role">
                <option {{ $user->role === "user" ? 'selected' : ''}}>user</option>
                <option {{ $user->role === "premium" ? 'selected' : ''}}>premium</option>
                <option {{ $user->role === "admin" ? 'selected' : ''}}>admin</option>
            </select>
        </x-form.container>

        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>