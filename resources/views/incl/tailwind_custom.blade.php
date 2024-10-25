<style type="text/tailwindcss">
    @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
    
 * {
    @apply m-0 p-0 box-border;
}

body {
    @apply bg-[#0c001c] font-poppins;
}

a {
    @apply text-[#f1f3f2] no-underline;
}

canvas {
    @apply w-full;
}

img {
    @apply object-cover;
}

input[type="radio"]:checked + label {
    border-color: #6c5ce7; /* indigo color */
    
}

  /* Default unselected label */
  .chart label {
    @apply border border-transparent; /* Transparent border to ensure consistent size */
  }

  .btn-date {
    @apply py-2 px-3 rounded-full font-semibold text-xs;
}

.btn-date.selected {
    @apply border-black border text-black;
}

.btn-date:not(.selected) {
    @apply border-transparent border bg-gray-100;
}


  </style>