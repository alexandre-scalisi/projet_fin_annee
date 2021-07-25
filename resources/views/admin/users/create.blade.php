<x-layouts.admin>
    <x-title class="mb-4">Créer Utilisateur</x-title>
    
    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        @csrf
        <x-form.basic-input name="name" text="Nom" :value="old('name')"/>
        
        <x-form.basic-input type="email" name="email" text="Email" :value="old('email')"/> 
        
        <x-form.basic-input type="password" name="password" text="Mot de passe" />
        
        <x-form.basic-input type="password" name="password_confirmation" text="Confirmer le mot de passe" />

        <x-form.container error="photo">
            <div x-data="{ obj: window.edit() }" x-init="obj.init()">
                <label for="image-input" class="block">Image (4/3 recommandé)</label>
                <input type="file" name="photo" accept="image/*" id="image-input">
                <div class="w-20 h-20 relative hidden" id="preview-box">
                    <button @click.prevent="obj.deleteImage()" class="absolute right-4 z-50 text-red-600 text-2xl" style="text-shadow: 1px 1px 2px black;">&times;</button>
                    <img id="image" class="w-full h-full rounded-full">
                </div>
                <p class="text-red-500 hidden" id="invalid-msg">Format invalide, formats autorisés: jpg, jpeg, png</p>
            </div>
        </x-form.container>
        
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