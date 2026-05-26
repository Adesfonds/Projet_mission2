@extends('app')

@section('title', 'Partenariats de VEM')

@section('content')

    <section id="partenariats" class="max-w-5xl mx-auto py-16 px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900 mb-6 leading-tight">
                Partenariats VEM
            </h1>

            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Vercorium Extraction & Modélisation collabore avec des acteurs académiques,
                industriels et financiers pour développer une exploitation responsable et innovante.
            </p>
        </div>

        <div class="space-y-8">

            <!-- Académique -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    Partenariats académiques
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Université Grenoble Alpes – recherche sur les matériaux et la modélisation des données.</li>
                    <li>Doctorants et post-doctorants contribuant aux modèles prédictifs du vercorium.</li>
                </ul>
            </div>

            <!-- Financement -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    Investisseurs et financements
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Fonds européens dédiés aux matières premières critiques.</li>
                    <li>Investisseurs régionaux soutenant le développement des infrastructures VEM.</li>
                </ul>
            </div>

            <!-- Industriel -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    Partenaires industriels et logistiques
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Entreprises locales spécialisées dans le transport et la logistique du minerai.</li>
                    <li>PME technologiques développant des outils numériques et solutions métier.</li>
                </ul>
            </div>

            <!-- Objectifs -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">
                <h2 class="text-2xl font-bold text-green-800 mb-4">
                    Objectifs des partenariats
                </h2>

                <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-5">
                    <li>Renforcer l’innovation scientifique autour du vercorium.</li>
                    <li>Garantir une exploitation minière responsable et durable.</li>
                    <li>Assurer la traçabilité et la fiabilité des données.</li>
                    <li>Développer l’infrastructure technique et numérique de VEM.</li>
                </ul>
            </div>

        </div>

    </section>

@endsection
