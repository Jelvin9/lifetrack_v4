<!-- resources/views/inclu/tailwind_config.blade.php -->
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          poppins: ['Poppins', 'sans-serif'],
        },
        colors: {
          customGray: '#f1f3f2',
          linkGray: '#ccc',
          primary: '#031224',
          secondary: '#eff6ff',
        },
        padding: {
          nav: '8px 14px',
          '2.5': '10px'
        },
        borderRadius: {
          '3xl': '20px',
          '50': '50%',
        },
        width: {
          '1/10': '10%',
        },
        spacing: {
          '18': '4.5rem',
          '30': '7.5rem',
        },
      },
    },
  }
</script>
