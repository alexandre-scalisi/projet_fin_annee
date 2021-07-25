<x-layouts.admin>
    <x-title class="mb-4">Modifier utilisateur {{ $user->name }}</x-title>
    
    <form method="POST" action={{ route('admin.users.update', $user->id) }} enctype="multipart/form-data" x-data="" x-init="window.edit">
        @csrf
        @method('PUT')

        <x-form.basic-input name="name" text="Nom" :value="$user->name"/>
            
        <x-form.basic-input type="email" name="email" text="Email" :value="$user->email"/> 
                
        <x-form.basic-input type="password" name="current_password" text="Mot de passe actuel"/>

        <x-form.basic-input type="password" name="password" text="Nouveau mot de passe"/>
        
        <x-form.basic-input type="password" name="password_confirmation" text="Confirmer nouveau mot de passe" />
            
        <x-form.container error="photo">
            <div x-data="{ obj: window.edit() }" x-init="obj.init()">
                <label for="image-input" class="block">Image (4/3 recommandé)</label>
                <input type="file" name="photo" accept="image/*" id="image-input">
                <div class="w-20 h-28 relative hidden" id="preview-box">
                    <button @click.prevent="obj.deleteImage()" class="absolute right-4 z-50 text-red-600 text-2xl" style="text-shadow: 1px 1px 2px black;">&times;</button>
                    <img src="{{ $user->profile_photo_url }}" id="image" class="w-20 h-20 rounded-full">
                </div>
                <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            </div>
        </x-form.container>
        
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