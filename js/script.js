// Menunggu hingga seluruh konten HTML dasar dimuat
document.addEventListener("DOMContentLoaded", function() {

    // Fungsi untuk memuat file HTML ke dalam elemen placeholder
    const loadComponent = (url, placeholderId) => {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Gagal memuat ${url}: ${response.statusText}`);
                }
                return response.text();
            })
            .then(data => {
                document.getElementById(placeholderId).innerHTML = data;
            })
            .catch(error => console.error(error));
    };

    // Memuat Navbar, lalu menjalankan skrip yang bergantung padanya
    loadComponent('components/navbar.html', 'navbar-placeholder').then(() => {
        // Skrip untuk menu hamburger (harus dijalankan SETELAH navbar dimuat)
        const hamburger = document.querySelector(".hamburger");
        const navMenu = document.querySelector(".nav-menu");

        if (hamburger && navMenu) {
            hamburger.addEventListener("click", () => {
                hamburger.classList.toggle("active");
                navMenu.classList.toggle("active");
            });

            document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
                hamburger.classList.remove("active");
                navMenu.classList.remove("active");
            }));
        }
        
        // Skrip untuk menandai link navigasi yang aktif
        const currentPage = window.location.pathname.split("/").pop(); // Mendapatkan nama file (misal: "about.html")
        const navLinks = document.querySelectorAll('.nav-menu a.nav-link');
        
        navLinks.forEach(link => {
            const linkPage = link.getAttribute('href').split("/").pop();
            if (linkPage === currentPage || (currentPage === '' && linkPage === 'index.html')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });

    // Memuat Footer
    loadComponent('components/footer.html', 'footer-placeholder');

});