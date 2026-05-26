@extends('app')

@section('title', 'Histoire - VEM')

@section('content')

    <section id="histoire" class="max-w-5xl mx-auto py-16 px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900 mb-6 leading-tight">
                L’histoire de VEM
            </h1>

            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                De la découverte du vercorium à la structuration d’une entreprise innovante,
                VEM s’est construite autour de la recherche scientifique et de l’exploration technologique.
            </p>
        </div>

        <div class="space-y-8">

            <!-- Origine -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    2023 — La découverte du vercorium
                </h2>

                <p class="text-gray-700 leading-8">
                    L’histoire de VEM débute lors d’une mission exploratoire dans le massif du Vercors.
                    Une équipe de géologues met en évidence un <strong>minerai inédit aux propriétés électrochimiques prometteuses</strong>,
                    rapidement nommé vercorium.
                </p>
            </div>

            <!-- Fondation -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    2024 — Fondation de VEM
                </h2>

                <p class="text-gray-700 leading-8 mb-4">
                    Face au potentiel stratégique de cette découverte, <strong>Jean-Baptiste Maurin</strong>,
                    <strong>Dr. Isabelle Morel</strong> et <strong>Marc Delaunay</strong> fondent
                    Vercorium Extraction & Modélisation à Valence.
                </p>

                <p class="text-gray-700 leading-8">
                    L’entreprise structure ses activités autour de la recherche, de l’extraction et de la modélisation des données.
                </p>
            </div>

            <!-- Développement -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    2024 — Premiers développements
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Installation du siège social et lancement des activités.</li>
                    <li>Campagne de forage exploratoire dans le Vercors.</li>
                    <li>Partenariat avec l’Université Grenoble Alpes.</li>
                    <li>Recrutement des premiers data scientists.</li>
                </ul>
            </div>

            <!-- Financement -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    2024 — Levée de fonds
                </h2>

                <p class="text-gray-700 leading-8">
                    Une levée de fonds de <strong>1,2 million d’euros</strong>, soutenue par des investisseurs régionaux
                    et un fonds européen, permet d’accélérer le développement de VEM.
                    Un site pilote est installé dans le Vercors.
                </p>
            </div>

            <!-- Structuration -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    2025 — Structuration technologique
                </h2>

                <p class="text-gray-700 leading-8">
                    VEM recrute un responsable informatique et sécurité afin de construire un système d’information
                    unifié, sécurisé et évolutif, capable d’accompagner la croissance de l’entreprise.
                </p>
            </div>

            <!-- Vision -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    Aujourd’hui — Une vision ambitieuse
                </h2>

                <p class="text-gray-700 leading-8">
                    VEM poursuit son développement avec une ambition claire :
                    <strong>allier innovation technologique, excellence scientifique et responsabilité environnementale</strong>
                    dans l’exploitation du vercorium.
                </p>
            </div>

        </div>

    </section>

@endsection
