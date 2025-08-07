<?php
require('views/template/header.php');
require('views/template/navbar.php');
?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-primary-blue">Employés</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-primary bg-primary-green border-0" data-bs-toggle="modal" data-bs-target="#addAcheteurModal">
                            <i class="bi bi-person-plus me-2"></i>
                            Nouvel Employé
                        </button>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher un employé...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Tous les sites</option>
                            <option>Site A</option>
                            <option>Site B</option>
                            <option>Site C</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>En attente</option>
                            <option>Finalisé</option>
                        </select>
                    </div>
                </div>

                <div class="row" id="acheteurs-cards-container">
                    <div id="no-items-message" class="col-12 text-center text-muted">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="card-title"> Table des Employes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="">
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>
                                            Nom
                                            </th>
                                            <th>
                                            Email
                                            </th>
                                            <th>
                                            Pseudo
                                            </th>
                                            <th>
                                            Telephone
                                            </th>
                                            <th>
                                            Intitulé
                                            </th>
                                            <th>
                                            Poste
                                            </th>
                                            <th>
                                            Photo
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <!-- affiche un message si la table acheteur est vide -->
                                            <!-- <tr class ="ligne">Aucun Employé dans la Base de données</tr> -->
                                        <!--  -->

                                        
                                        <tr class="ligne">
                                            <td>
                                            WELADJI HILARY
                                            </td>
                                            <td>
                                                hilaryweladji@gmail.com
                                            </td>
                                            <td>
                                                hilary                                        
                                            </td>
                                            <td>
                                                670000000
                                            </td>
                                            <td>
                                                Developpeur
                                            </td>
                                            <td>
                                                Developpeur Full Stack
                                            </td> 
                                            <td>
                                                <img src="../views/assets/img/employes/hilary.jpg" alt="Photo de Hilary" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            </td>
                                            <td style="color:blue; cursor:pointer;">
                                            <a href = "H_updateEmployeController.php<?='?H_idEmploye='.$_SESSION['H_idEmploye']?>">Modifier</a>
                                            </td>
                                        </tr>
                            
                                        </tbody>

                                    </table>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center" id="pagination-controls">
                        </ul>
                </nav>
            </main>
        </div>
    </div>



    <button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#addAcheteurModal">
        <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- <script>
        const allItems = <?php echo $json_items; ?>;
    </script>
    <script src="../views/assets/js/paginationAcheteurs.js"></script> -->
</body>
</html>