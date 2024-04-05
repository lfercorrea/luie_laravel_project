/**
 * Arquivo de customização js.
 * 
 * Qualquer inicialização de função do materialize CSS deverá ser 
 * incorporada neste arquivo, bem como qualquer função JS personalizada.
 * 
 * @nando.correa
 */

/** dropdown do materialize css. é o menu usado na navbar, para listar categorias */
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, {
      alignment: 'right',
      coverTrigger: false,
      constrainWidth: false
    });
  });

/** Modal do materialize css - usado principalmente na gestão de estoques, mas é um popup de confirmação
 * útil para qualquer região do site
 */
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);

    var deleteButtons = document.querySelectorAll('.modal-trigger');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.dataset.productId;
            var form = document.getElementById('delete-form');
            form.action = '/admin/excluir/produto/' + productId;
        });
    });
});

/** seletor de checkbox múltiplas */
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});

/** Sidenav - painel de administração */
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
    // var instance = M.Sidenav.getInstance(elems[0]);
    // instance.open();
  });

/** FAB do materialize, botão responsivo de navegação */
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems);
});