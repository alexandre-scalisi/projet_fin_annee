<x-layouts.admin>
    <h1>Ajouter Utilisateur</h1>
    
    <form method="POST" action={{ route('admin.users.store') }}>
        @csrf
        <div class="block mb-4">
        <label for="nom">Nom</label>
        <input type="text" name="name" id="name">
        
        </div>
        <div class="text-red-500">
            @error('name')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
        <label for="email">email</label>
        <input type="email" name="email" id="email">
        
        </div>
        <div class="text-red-500">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        
        </div>
        <div class="text-red-500">
            @error('password')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
        <label for="password_confirmation">confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        
        </div>
        <div class="text-red-500">
            @error('password')
            {{ $message }}
            @enderror
        </div>
        <div class="block mb-4">
            <select name="role">
                <option>user</option>
                <option>premium</option>
                <option>admin</option>
            </select>
        </div>
        <div class="text-red-500">
            @error('role')
            {{ $message }}
            @enderror
        </div>
        
       
        
        <button class="bg-black px-3 py-2 text-white">Envoyer</button>
    </form>
</x-layouts.admin>