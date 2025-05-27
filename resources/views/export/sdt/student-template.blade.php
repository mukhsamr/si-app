<table>
    <thead>
        <tr>
            <th>ID Siswa</th>
            <th>Siswa</th>
            <th>NIS</th>
            <th>UID Siswa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->nis }}</td>
            <td>{{ $student->uid }}</td>
        </tr>
        @endforeach
    </tbody>
</table>