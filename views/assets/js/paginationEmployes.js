// Get references to HTML elements
const itemsContainer = document.getElementById('employes-cards-container');
const paginationControls = document.getElementById('pagination-controls');
const noItemsMessage = document.getElementById('no-items-message');

// Pagination settings
const itemsPerPage = 6;
let currentPage = 1;

// Fonction pour rendre les éléments de la page actuelle
function displayItems(items, wrapper, rowsPerPage, page) {
    wrapper.innerHTML = '';
    noItemsMessage.innerHTML = '';

    page--;

    const start = rowsPerPage * page;
    const end = start + rowsPerPage;
    const paginatedItems = items.slice(start, end);

    if (paginatedItems.length === 0) {
        noItemsMessage.innerHTML = '<p>Aucun employé à afficher pour cette page.</p>';
        return;
    }

    paginatedItems.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'col-lg-4 col-md-6 mb-4';

        itemElement.innerHTML = `
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary-green text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">${item.nomEmploye || 'Nom Inconnu'}</h6>
                    <span class="badge bg-light text-dark">Actif</span>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Pseudo:</strong></div>
                        <div class="col-sm-8">${item.pseudoEmploye || 'Aucun pseudo'}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Âge:</strong></div>
                        <div class="col-sm-8">${F_calculerAge(item.dateNaisEmploye) || 'N/A'} ans</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Adresse:</strong></div>
                        <div class="col-sm-8">${item.adresseEmploye || 'Aucune adresse'}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Téléphone:</strong></div>
                        <div class="col-sm-8">${item.telephoneEmploye || 'Aucun numéro'}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Poste:</strong></div>
                        <div class="col-sm-8">${item.libelleFonction || 'Non spécifié'}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100" role="group">
                        <a href="H_updateEmployeController.php?H_idEmploye=${item.idEmploye || ''}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
        `;
        wrapper.appendChild(itemElement);
    });
}

// Fonction pour calculer l'âge (PHP F_calculerAge équivalent)
function F_calculerAge(dateNaissance) {
    if (!dateNaissance) return '';
    const birthDate = new Date(dateNaissance);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

// Fonction pour configurer les boutons de pagination
function setupPagination(items, wrapper, rowsPerPage) {
    wrapper.innerHTML = '';

    const pageCount = Math.ceil(items.length / rowsPerPage);

    let prevButton = document.createElement('li');
    prevButton.classList.add('page-item');
    let prevLink = document.createElement('a');
    prevLink.classList.add('page-link');
    prevLink.href = '#';
    prevLink.innerHTML = '&laquo; Précédent';
    prevButton.appendChild(prevLink);
    prevLink.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            displayItems(items, itemsContainer, itemsPerPage, currentPage);
            setupPagination(items, paginationControls, itemsPerPage);
        }
    });
    wrapper.appendChild(prevButton);

    for (let i = 1; i <= pageCount; i++) {
        let btn = paginationButton(i, items);
        wrapper.appendChild(btn);
    }

    let nextButton = document.createElement('li');
    nextButton.classList.add('page-item');
    let nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = '#';
    nextLink.innerHTML = 'Suivant &raquo;';
    nextButton.appendChild(nextLink);
    nextLink.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage < pageCount) {
            currentPage++;
            displayItems(items, itemsContainer, itemsPerPage, currentPage);
            setupPagination(items, paginationControls, itemsPerPage);
        }
    });
    wrapper.appendChild(nextButton);

    const pageButtons = wrapper.querySelectorAll('.page-item');
    pageButtons.forEach(btn => {
        const link = btn.querySelector('.page-link');
        if (link && parseInt(link.textContent) === currentPage) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });

    if (currentPage === 1) {
        prevButton.classList.add('disabled');
    } else {
        prevButton.classList.remove('disabled');
    }
    if (currentPage === pageCount) {
        nextButton.classList.add('disabled');
    } else {
        nextButton.classList.remove('disabled');
    }
}

// Fonction utilitaire pour créer un seul bouton de pagination
function paginationButton(page, items) {
    let button = document.createElement('li');
    button.classList.add('page-item');
    let link = document.createElement('a');
    link.classList.add('page-link');
    link.href = '#';
    link.textContent = page;
    button.appendChild(link);

    link.addEventListener('click', (e) => {
        e.preventDefault();
        currentPage = page;
        displayItems(items, itemsContainer, itemsPerPage, currentPage);
        setupPagination(items, paginationControls, itemsPerPage);
    });

    return button;
}

// Initialise la pagination au chargement de la page
window.onload = function() {
    if (!allItems || allItems.length === 0) {
        noItemsMessage.innerHTML = '<p class="mt-3 text-center">Aucun employé trouvé.</p>';
        paginationControls.innerHTML = '';
    } else {
        displayItems(allItems, itemsContainer, itemsPerPage, currentPage);
        setupPagination(allItems, paginationControls, itemsPerPage);
    }
};