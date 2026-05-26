@extends('app')

@section('title', 'Présentation - VEM')

@section('content')

    <section id="presentation-entreprise" class="max-w-5xl mx-auto py-16 px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900 mb-6 leading-tight">
                Présentation de l’entreprise
            </h1>

            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Vercorium Extraction & Modélisation des données (VEM) est une entreprise innovante
                fondée autour d’une découverte scientifique majeure dans le massif du Vercors.
            </p>
        </div>

        <div class="space-y-8">

            <!-- Origine -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <p class="text-gray-700 leading-8 text-lg">
                    <strong>VEM</strong> est une entreprise fondée en 2024 à Valence, issue de la découverte
                    d’un minerai inédit : le <strong>vercorium</strong>.
                </p>
            </div>

            <!-- Approche -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <p class="text-gray-700 leading-8 text-lg mb-6">
                    À la croisée de l’exploitation minière, de la science des matériaux et de l’analyse de données,
                    VEM développe une approche fondée sur :
                </p>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>La recherche scientifique avancée,</li>
                    <li>La modélisation numérique des données,</li>
                    <li>Une exploitation responsable et durable des ressources.</li>
                </ul>
            </div>

            <!-- Activités -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Activités principales
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Extraction expérimentale du vercorium sur un site pilote dans le Vercors.</li>
                    <li>Recherche scientifique en partenariat avec l’Université Grenoble Alpes.</li>
                    <li>Analyse et modélisation des données liées aux propriétés du minerai.</li>
                </ul>
            </div>

            <!-- Applications -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Applications du vercorium
                </h2>

                <p class="text-gray-700 leading-8">
                    Les premières études ont mis en évidence un fort potentiel du vercorium dans plusieurs domaines :
                    batteries nouvelle génération, alliages ultralégers pour l’aéronautique,
                    ainsi que des applications avancées en électronique et semi-conducteurs.
                </p>
            </div>

            <!-- Organisation -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Organisation et implantation
                </h2>

                <p class="text-gray-700 leading-8">
                    Implantée entre Valence, le Vercors et Grenoble, VEM s’appuie sur une équipe
                    pluridisciplinaire de scientifiques, ingénieurs et techniciens.
                </p>

                <p class="text-gray-700 leading-8 mt-4">
                    L’entreprise développe un modèle d’exploitation durable basé sur des outils numériques
                    performants et une gestion rigoureuse des données scientifiques et environnementales.
                </p>
            </div>

        </div>

    </section>

@endsection
