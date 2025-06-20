@extends('layouts.app')

@section('title', 'A propos ')

@section('content')
    


    <div class="container">
        <div class="main-content">
            <h2>Notre Mission</h2>
            <p>
                Chez [Nom de votre Pharmacie], notre mission est de fournir des services pharmaceutiques
                de haute qualité, des conseils personnalisés et un soutien attentif à notre communauté.
                Nous nous engageons à améliorer la santé et le bien-être de nos patients grâce à une
                gestion rigoureuse et une expertise professionnelle.
            </p>

            <h2>Notre Équipe de Gestionnaires</h2>
            <p>
                Notre pharmacie est gérée par une équipe dédiée de professionnels expérimentés, passionnés
                par la santé et le service à la clientèle. Voici quelques-uns des membres clés de notre équipe :
            </p>

            <div class="team-member">
                <img src="{{ asset('images/Directeur.jpg') }}" alt="Photo de Jean Dupont">
                <div class="team-member-info">
                    <h3>Jean Dupont</h3>
                    <p><strong>Pharmacien Titulaire & Directeur Général</strong></p>
                    <p>
                        Jean a plus de 20 ans d'expérience dans l'industrie pharmaceutique. Son expertise
                        en gestion de pharmacie et sa passion pour le service client sont les piliers
                        de notre établissement. Il veille à ce que toutes les opérations se déroulent
                        sans accroc et que nos patients reçoivent les meilleurs soins possibles.
                    </p>
                    <p><em>"Notre priorité est votre santé et votre satisfaction."</em></p>
                </div>
            </div>

            <div class="team-member">
                <img src="{{ asset('images/pharmacienne1.jpg') }}" alt="Photo de Marie Curie">
                <div class="team-member-info">
                    <h3>Marie Curie</h3>
                    <p><strong>Responsable des Opérations & Qualité</strong></p>
                    <p>
                        Marie est notre experte en matière de conformité et de qualité. Elle s'assure que
                        tous nos produits et services répondent aux normes les plus élevées et que nos
                        procédures sont toujours à jour avec les réglementations en vigueur. Son souci du
                        détail est inestimable pour la sécurité de nos patients.
                    </p>
                    <p><em>"La rigueur est la clé de la confiance."</em></p>
                </div>
            </div>

            <div class="team-member">
                <img src="{{ asset('images/pharmacien2.jpg') }}" alt="Photo de David Martin">
                <div class="team-member-info">
                    <h3>David Martin</h3>
                    <p><strong>Chef de l'Approvisionnement</strong></p>
                    <p>
                        David est responsable de la gestion de nos stocks et de l'approvisionnement en
                        médicaments. Grâce à lui, nous nous assurons que nous avons toujours les produits
                        nécessaires disponibles pour nos patients. Son travail est crucial pour maintenir
                        la continuité de nos services.
                    </p>
                    <p><em>"Assurer la disponibilité pour votre bien-être."</em></p>
                </div>
            </div>

            <h2>Nos Valeurs</h2>
            <ul>
                <li><strong>Intégrité :</strong> Agir avec honnêteté et éthique dans toutes nos interactions.</li>
                <li><strong>Compassion :</strong> Faire preuve d'empathie et de soutien envers nos patients.</li>
                <li><strong>Excellence :</strong> Aspirer à l'excellence dans tous les aspects de nos services.</li>
                <li><strong>Innovation :</strong> Rester à la pointe des avancées pharmaceutiques.</li>
                <li><strong>Communauté :</strong> Contribuer positivement à la santé de notre communauté.</li>
            </ul>

            <h2>Nous Contacter</h2>
            <p>
                Pour toute question ou information complémentaire, n'hésitez pas à nous contacter :
            </p>
            <ul>
                <li><strong>Téléphone :</strong> [+22606913191]</li>
                <li><strong>Email :</strong> contact@pharmaciedofinsaamu.com</li>
                <li><strong>Adresse :</strong> Burkina-Faso,Ouagadougou,Dassasgo</li>
            </ul>
            <p>
                Nous sommes impatients de vous servir !
            </p>
        </div>
    </div>
    @endsection

    