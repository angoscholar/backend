<?php

namespace Database\Seeders;

use App\Models\Artigo;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Utilizador admin ----
        User::updateOrCreate(
            ['email' => 'admin@mubissule.ao'],
            [
                'name' => 'Administrador Mubissule',
                'password' => 'Mubissule@2026',   // hashed via cast
                'role' => 'admin',
                'api_token' => Str::random(64),
                'email_verified_at' => now(),
            ],
        );

        // ---- Artigo dinâmico (usa o mesmo template do front) ----
        Artigo::updateOrCreate(
            ['slug' => 'diabetes-tipo-2-sintomas-tratamento'],
            [
                'titulo' => 'Diabetes Tipo 2: Abordagem Natural no Mubissule',
                'categoria' => 'Condições Tratadas',
                'resumo' => 'Abordagem integrativa do Mubissule para diabetes tipo 2 — fitoterapia, nutrição funcional e acompanhamento clínico.',
                'conteudo' => "<h2>O que é a diabetes tipo 2?</h2>\n<p>Doença metabólica caracterizada pela resistência à insulina e elevação crónica da glicemia. No Mubissule combinamos fitoterapia, nutrição funcional e acompanhamento clínico personalizado.</p>\n<h2>Sintomas frequentes</h2>\n<ul><li>Sede excessiva e boca seca</li><li>Urinar com frequência</li><li>Cansaço persistente</li><li>Feridas de cicatrização lenta</li></ul>\n<h2>Como tratamos</h2>\n<p>Plano de 3 fases: <strong>desintoxicação</strong>, <strong>reeducação alimentar</strong> e <strong>manutenção fitoterápica</strong>.</p>",
                'imagem' => '/image/diabetes-tipo-2-sintomas-tratamento.webp',
                'autor' => 'Mubissule — Centro de Medicina Natural',
                'publicado' => true,
                'publicado_em' => now(),
            ],
        );

        // ---- Páginas dinâmicas ----
        Page::updateOrCreate(
            ['slug' => 'sobre'],
            [
                'titulo' => 'Sobre o Mubissule',
                'meta_description' => 'Conheça o Mubissule — Centro de Medicina Natural em Angola, com mais de 10 anos de experiência em saúde integrativa.',
                'conteudo' => "<p>O <strong>Mubissule</strong> é um centro de medicina natural sediado em Angola, dedicado à saúde integrativa através de fitoterapia, nutrição funcional e acompanhamento clínico personalizado.</p><p>Com mais de <strong>10 anos de experiência</strong> e mais de <strong>5.000 pacientes</strong> atendidos em 18 províncias, promovemos vida em equilíbrio.</p>",
            ],
        );

        Page::updateOrCreate(
            ['slug' => 'privacidade'],
            [
                'titulo' => 'Política de Privacidade',
                'meta_description' => 'Política de privacidade do Mubissule — como recolhemos, tratamos e protegemos os seus dados pessoais.',
                'conteudo' => "<p>O Mubissule respeita a sua privacidade. Recolhemos apenas os dados necessários para agendamento e acompanhamento clínico e nunca partilhamos com terceiros sem consentimento.</p><h2>Dados recolhidos</h2><ul><li>Nome e contacto</li><li>Histórico clínico partilhado voluntariamente</li></ul><h2>Contacto</h2><p>Para exercer os seus direitos escreva para <a href=\"mailto:privacidade@mubissule.ao\">privacidade@mubissule.ao</a>.</p>",
            ],
        );

        Page::updateOrCreate(
            ['slug' => 'termos'],
            [
                'titulo' => 'Termos de Uso',
                'meta_description' => 'Termos e condições de uso dos serviços e website do Mubissule.',
                'conteudo' => "<p>Ao utilizar o website e os serviços do Mubissule aceita os presentes termos. Os conteúdos têm carácter informativo e não substituem consulta clínica presencial.</p>",
            ],
        );
    }
}
