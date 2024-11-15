document.addEventListener('DOMContentLoaded', () => {
    const htmlElement = document.documentElement;
    
    // Função para alternar o modo escuro
    function toggleDarkMode() {
      if (localStorage.theme === 'dark') {
        htmlElement.classList.remove('dark');
        localStorage.theme = 'light';
      } else {
        htmlElement.classList.add('dark');
        localStorage.theme = 'dark';
      }
    }
  
    // Verifica a preferência do usuário ao carregar a página
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      htmlElement.classList.add('dark');
    }
  
    // Adiciona o evento de clique no botão para alternar
    document.getElementById('toggleDarkMode').addEventListener('click', toggleDarkMode);
  });
  