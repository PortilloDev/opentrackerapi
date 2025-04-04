<footer class="bg-secondary text-black py-6">
    <div class="container mx-auto text-center">
        <p>&copy; {{now()->format('Y')}} <strong>Artesanos del Código</strong>. Todos los derechos reservados.</p>
        <p>Si deseas contactar con nosotros:<strong><a href="mailto:contacto@notasweb.me" class="btn btn-primary"> contacto@notasweb.me </a></strong></p>
        <nav class="flex justify-center space-x-4 mt-4">
            <a href="{{route('privacy')}}" class="hover:underline">Política de Privacidad</a>
            <a href="{{route('conditions')}}" class="hover:underline">Términos y Condiciones</a>
            <a href="{{route('cookies')}}" class="hover:underline">Política de Cookies</a>
        </nav>
        <div class="flex justify-center space-x-4 mt-4">
            <a href="https://www.facebook.com/profile.php?id=61556931680867" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="https://www.instagram.com/artesanosdelcodigo/" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fab fa-instagram fa-2x"></i>
            </a>
            <a href="https://www.linkedin.com/in/ivan-portillo-perez/" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fab fa-linkedin fa-2x"></i>
            </a>
            <a href="https://notasweb.me" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fab fa-blogger-b fa-2x"></i>
            </a>
            <a href="https://open.spotify.com/show/1TqvkZRtIpTTdEus9i2l7j" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fab fa-spotify fa-2x"></i>
            </a>
            <a href="https://www.ivoox.com/podcast-artesanos-del-codigo_sq_f12479098_1.html" target="_blank" class="text-black hover:text-blue-500 transform hover:scale-125 transition duration-300">
                <i class="fas fa-podcast fa-2x"></i>
            </a>
        </div>

    </div>
</footer>
