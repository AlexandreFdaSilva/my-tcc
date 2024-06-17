<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        About::create([
            'title' => 'Sobre nós',
            'summary' => 'O Núcleo de Investigações Químico-Farmacêuticas (NIQFAR) tem por finalidade produzir e fomentar trabalhos de cunho científico, em especial, que se enquadram em algumas áreas consideradas prioritárias para o curso de farmácia, como o estudo químico, microbiológico e farmacológico de plantas medicinais e síntese de substâncias bioativas.\n\n Estima-se através de busca de base da dados, cerca de 500 artigos científicos produzidos pelo núcleo ou em parceria com o mesmo e mais de 100 plantas que integram a flora catarinense já foram estudadas pelo grupo.\n\n O NIQFAR completa em 2025, 30 anos de atividades de pesquisa, com ênfase na área de produtos naturais e sintéticos bioativos.\n Almejando-se registrar a história do núcleo, a presente base de dados foi concebida. O objetivo central da criação dessa plataforma é a centralização e catalogação de produtos naturais isolados e identificados na UNIVALI e/ou parceria com outras instituições/universidades, a fim de possibilitar a pesquisa de novas moléculas bioativas.\n\nA criação da base permitirá uma melhor integração entre as pesquisas conduzidas na universidade pelo NIQFAR, facilitando a pesquisa e extração de dados por meio de recursos computacionais por profissionais/acadêmicos ligados ao núcleo. Este trabalho é o resultado entre uma parceria do curso de Biomedicina e Engenharia de Computação, inédita e cheia de futuras perspectivas de sucesso.\n \n Idealizado por:\n Profa. Me. Franciele Samanta Bohr Florenço\n \n Realizado por:\n Alexandre Fernandes da Silva\n Prof. Me. Lucas Debatin\n Prof. Dr. Bruno Araujo Cautiero Horta\n \n Agradecimentos:\n Profa. Dra. Angela Malheiros\n Prof. Dr. Luiz Carlos Klein Júnior',
            'link' => 'https://www.univali.br/graduacao/farmacia-itajai/laboratorios/Paginas/niqfar-nucleo-de-investigacoes-quimico-farmaceuticas.aspx',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
