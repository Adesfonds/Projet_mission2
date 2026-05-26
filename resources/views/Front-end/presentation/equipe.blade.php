@extends('app')

@section('title', 'Équipe - VEM')

@section('content')

    <section id="equipe" class="max-w-5xl mx-auto py-16 px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900 mb-6 leading-tight">
                Notre équipe
            </h1>

            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Vercorium Extraction & Modélisation réunit une équipe pluridisciplinaire
                engagée dans la recherche, l’innovation et l’exploitation responsable du vercorium.
            </p>
        </div>

        <div class="space-y-8">

            <!-- Vision globale -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <p class="text-gray-700 leading-8 text-lg">
                    VEM rassemble aujourd’hui une <strong>équipe d’environ trente collaborateurs</strong>,
                    unis par une même ambition : valoriser le potentiel du vercorium grâce à une exploitation
                    scientifique et durable.
                </p>
            </div>

            <!-- Direction -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Direction et administration
                </h2>

                <ul class="space-y-4 text-gray-700 leading-relaxed list-disc pl-5">
                    <li><strong>Jean-Baptiste Maurin</strong> — Directeur général, ingénieur en géosciences et cofondateur.</li>
                    <li><strong>Dr. Isabelle Morel</strong> — Référente scientifique, spécialiste en science des matériaux.</li>
                    <li><strong>Marc Delaunay</strong> — Responsable opérationnel, expert en gestion et logistique.</li>
                </ul>

                <p class="mt-6 text-gray-700 leading-8">
                    Ils sont accompagnés par une équipe administrative chargée de la coordination interne
                    et de la communication externe.
                </p>
            </div>

            <!-- Exploitation -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Exploitation minière
                </h2>

                <p class="text-gray-700 leading-8 mb-6">
                    Sur le site pilote du Vercors, une équipe spécialisée assure les opérations d’extraction expérimentale.
                </p>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Chef de site responsable des opérations.</li>
                    <li>Opérateurs de terrain en charge des extractions.</li>
                    <li>Techniciens logistiques pour le matériel et les flux.</li>
                </ul>

                <p class="mt-6 text-gray-700 leading-8">
                    Cette équipe travaille en étroite collaboration avec les chercheurs afin d’assurer la qualité
                    et la traçabilité des données terrain.
                </p>
            </div>

            <!-- Recherche -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-6">
                    Recherche, données et informatique
                </h2>

                <p class="text-gray-700 leading-8 mb-4">
                    La recherche et la modélisation scientifique constituent un pilier central de VEM.
                    Data scientists, data engineers et développeurs travaillent avec des chercheurs et doctorants
                    pour analyser les données issues de l’exploitation.
                </p>

                <p class="text-gray-700 leading-8">
                    Une équipe informatique et sécurité structure le système d’information de l’entreprise,
                    garantissant la sécurité des données et la connectivité entre les différents sites.
                </p>
            </div>

        </div>

    </section>

@endsection
