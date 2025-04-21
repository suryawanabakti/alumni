<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    protected $questions;

    public function __construct($data)
    {
        $this->data = $data;

        // Ambil semua question_text yang unik sebagai heading (selain user_id)
        $this->questions = collect($data)
            ->flatMap(fn($item) => collect($item['response'])->pluck('question_text'))
            ->unique()
            ->values()
            ->toArray();
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        // Heading pertama adalah user_id, lalu question_text dari response
        return array_merge($this->questions);
    }

    public function map($row): array
    {
        $user_id = $row['user_id'];
        $responses = collect($row['response'])->pluck('answer', 'question_text');

        // Susun jawaban sesuai dengan urutan headings
        $answers = [];
        foreach ($this->questions as $question) {
            $answers[] = isset($responses[$question]) ? json_decode($responses[$question], true) ?? $responses[$question] : '';
        }

        return array_merge($answers);
    }
}
