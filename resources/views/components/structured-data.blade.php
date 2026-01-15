@if(request()->routeIs('home') || request()->routeIs('landing'))
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "ENS Makassar",
    "description": "Bimbel kedinasan, tryout dan materi lengkap, latihan soal terbaru.",
    "url": "https://ens-makassar.com",
    "logo": "https://ens-makassar.com/img/logo.png",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "ID"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+62-821-9125-3023",
      "contactType": "Customer Service",
      "availableLanguage": "Indonesian"
    },
    "sameAs": [
      "https://www.instagram.com/azwara_learning",
      "https://www.tiktok.com/@ens.learning",
      "https://www.youtube.com/@ens-makassar"
    ],
    "offers": {
      "@type": "Offer",
      "category": "Educational Courses",
      "availability": "https://schema.org/InStock"
    }
  }
  </script>
@endif
