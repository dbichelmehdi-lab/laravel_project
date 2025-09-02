<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
  @vite('resources/css/app.css')


  <title>Home Page</title>
</head>

<body>

  <div class="flex max-h-screen bg-gray-100  overflow-hidden">

    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
      <!-- Content -->
      @include('admin.main')
    </div>
  </div>




  <!-- Content -->



</body>

</html>