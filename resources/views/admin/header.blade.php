<!-- Top Navbar -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-purple-700">Dashboard</h1>
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
        <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">SR</div>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-400">Logout</button>
        </form>
    
