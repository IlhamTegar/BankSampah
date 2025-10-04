<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garbage Bank</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100">

  <!-- Hero Section -->
  <section class="relative bg-gray-900 text-white"style="
    background: url('assets/images/background.jpg') no-repeat center center;
    background-size: cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
">
    <div class="absolute inset-0">
      <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29" alt="city background" class="w-full h-full object-cover opacity-70">
    </div>
    <div class="relative z-10 text-center py-24">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Garbage Bank</h1>
      <p class="mb-6">Transform your waste into value. Join our community of collectors and agents working together for a cleaner city.</p>
      <div class="flex justify-center gap-4">
        <button onclick="openModal('userRegisterModal')" class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-lg">Register as User</button>
        <button onclick="openModal('agentRegisterModal')" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg">Register as Agent</button>
      </div>
      <p class="mt-4">Already have an account? 
        <button onclick="openModal('loginModal')" class="underline">Login</button>
      </p>
      <p class="mt-2">
        <a href="#impact" class="underline">View Statistics</a>
      </p>
    </div>
  </section>

  <!-- Impact Section -->
  <section id="impact" class="py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">Our Impact So Far</h2>
    <p class="text-gray-600 mb-10">See how our community is making a difference in waste management and environmental sustainability.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
      <div class="bg-white p-6 rounded-xl shadow text-center">
        <div class="text-3xl">♻️</div>
        <h3 class="text-xl font-bold">2,203 kg</h3>
        <p class="text-gray-600">Total Waste Collected</p>
        <button onclick="toggleDetail('wasteDetail')" class="mt-4 text-blue-600 underline">View Detail</button>
      </div>
      <div class="bg-white p-6 rounded-xl shadow text-center">
        <div class="text-3xl">👥</div>
        <h3 class="text-xl font-bold">26</h3>
        <p class="text-gray-600">Active Agents</p>
        <button onclick="toggleDetail('agentDetail')" class="mt-4 text-blue-600 underline">View Detail</button>
      </div>
    </div>
  </section>

  <!-- Waste Detail -->
  <div id="wasteDetail" class="hidden max-w-5xl mx-auto bg-white p-6 mt-6 rounded-xl shadow">
    <h3 class="text-xl font-bold mb-4">Waste Statistics</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Pie chart wrapper supaya tetap bulat -->
      <div class="flex justify-center items-center">
        <div class="w-64 h-64"> <!-- ukuran fix 1:1 -->
          <canvas id="wastePieChart"></canvas>
        </div>
      </div>
      <canvas id="wasteBarChart"></canvas>
    </div>
  </div>

  <!-- Agent Detail -->
  <div id="agentDetail" class="hidden max-w-5xl mx-auto bg-white p-6 mt-6 rounded-xl shadow">
    <h3 class="text-xl font-bold mb-4">Agent Distribution</h3>
    <canvas id="agentBarChart"></canvas>
  </div>

  <!-- List Agen -->
  <section id="statistics" class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h3 class="text-2xl font-bold mb-4">Daftar Bank Sampah / Agen</h3>
    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2 text-left">Nama</th>
          <th class="border px-4 py-2 text-left">Alamat</th>
          <th class="border px-4 py-2 text-center">Banyak Sampah Bulan Lalu (kg)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border px-4 py-2">Bank Sampah Induk</td>
          <td class="border px-4 py-2">Jl. Merdeka No. 1</td>
          <td class="border px-4 py-2 text-center">320</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Agen Hijau Lestari</td>
          <td class="border px-4 py-2">Jl. Mawar No. 5</td>
          <td class="border px-4 py-2 text-center">210</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Bank Sampah Melati</td>
          <td class="border px-4 py-2">Jl. Kenanga No. 7</td>
          <td class="border px-4 py-2 text-center">145</td>
        </tr>
      </tbody>
    </table>
  </section>

  <!-- Map -->
  <section class="max-w-6xl mx-auto mt-6 bg-white p-6 rounded-xl shadow">
    <h3 class="text-2xl font-bold mb-4">Peta Persebaran Agen</h3>
    <div id="map" class="h-96 rounded-lg"></div>
  </section>

  <!-- Overlay -->
  <div id="modalOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"></div>

  <!-- Login Modal -->
  <div id="loginModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md relative">
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black">✖</button>
      <h2 class="text-2xl font-bold mb-4">Login</h2>
      <p class="text-gray-600 mb-6">Sign in to your account to access your waste collection dashboard.</p>
      <form>
        <input type="email" placeholder="Enter your email" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="password" placeholder="Enter your password" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <div class="flex gap-2">
          <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Login as User</button>
          <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Login as Agent</button>
        </div>
      </form>
    </div>
  </div>

  <!-- User Register Modal -->
  <div id="userRegisterModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md relative">
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black">✖</button>
      <h2 class="text-2xl font-bold mb-4">Register as User</h2>
      <form>
        <input type="text" placeholder="Full Name" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="email" placeholder="Email" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="password" placeholder="Password" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="text" placeholder="Phone Number" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <textarea placeholder="Address" class="w-full mb-3 border rounded-lg px-4 py-2"></textarea>
        <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Create User Account</button>
      </form>
    </div>
  </div>

  <!-- Agent Register Modal -->
  <div id="agentRegisterModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md relative">
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black">✖</button>
      <h2 class="text-2xl font-bold mb-4">Register as Agent</h2>
      <form>
        <input type="text" placeholder="Full Name" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="email" placeholder="Email" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="password" placeholder="Password" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <input type="text" placeholder="Phone Number" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <select class="w-full mb-3 border rounded-lg px-4 py-2">
          <option>Select Agent Type</option>
          <option>Individual</option>
          <option>Organization</option>
        </select>
        <input type="text" placeholder="Service Area" class="w-full mb-3 border rounded-lg px-4 py-2" />
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Create Agent Account</button>
      </form>
    </div>
  </div>

  <script>
    function toggleDetail(id) {
      const wasteDetail = document.getElementById("wasteDetail");
      const agentDetail = document.getElementById("agentDetail");
      if (id === "wasteDetail") {
        wasteDetail.classList.toggle("hidden");
        agentDetail.classList.add("hidden");
      } else {
        agentDetail.classList.toggle("hidden");
        wasteDetail.classList.add("hidden");
      }
    }

    // Chart.js dummy data
    new Chart(document.getElementById("wastePieChart"), {
      type: "pie",
      data: {
        labels: ["Plastic", "Paper", "Glass", "Metal"],
        datasets: [{
          data: [40, 25, 20, 15],
          backgroundColor: ["#f87171", "#60a5fa", "#34d399", "#fbbf24"]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    new Chart(document.getElementById("wasteBarChart"), {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr"],
        datasets: [{ label: "Kg", data: [300, 500, 400, 600], backgroundColor: "#34d399" }]
      }
    });
    new Chart(document.getElementById("agentBarChart"), {
      type: "bar",
      data: {
        labels: ["Central", "North", "South", "East", "West"],
        datasets: [{ label: "Agents", data: [5, 8, 4, 6, 3], backgroundColor: "#60a5fa" }]
      }
    });

    // Leaflet Map
    var map = L.map("map").setView([-6.2, 106.816666], 11);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { maxZoom: 19 }).addTo(map);
    L.marker([-6.2, 106.816666]).addTo(map).bindPopup("Bank Sampah Induk");
    L.marker([-6.25, 106.81]).addTo(map).bindPopup("Agen Hijau Lestari");
    L.marker([-6.22, 106.85]).addTo(map).bindPopup("Bank Sampah Melati");

    // Modal control
    function openModal(id) {
      document.getElementById("modalOverlay").classList.remove("hidden");
      document.querySelectorAll("#loginModal, #userRegisterModal, #agentRegisterModal")
        .forEach(m => m.classList.add("hidden"));
      document.getElementById(id).classList.remove("hidden");
    }
    function closeModal() {
      document.getElementById("modalOverlay").classList.add("hidden");
      document.querySelectorAll("#loginModal, #userRegisterModal, #agentRegisterModal")
        .forEach(m => m.classList.add("hidden"));
    }
    document.getElementById("modalOverlay").addEventListener("click", closeModal);
  </script>
</body>
</html>
