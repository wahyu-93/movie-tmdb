@extends('base')

@section('title', 'BeeCinemation | Movies')

@section('content')
    <div class="py-5 flex flex-row items-center">
        <span class="font-bold font-inter text-xl ml-28 mr-4">Sort</span>
        <div class="flex relative items-center">
            <select name="sort" id="sort" class="appearance-none bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] p-3 rounded-lg focus:outline-none pr-8">
                <option value="popularity.desc">Popularity (Descending)</option>
                <option value="popularity.asc">Popularity (Ascending)</option>
                <option value="vote_average.desc">Top Rated (Descending)</option>
                <option value="vote_average.asc">Top Rated (Ascending)</option>
            </select>

            <div class="absolute right-0 mr-2 pointer-events-none">
                <svg fill="#000000" height="14" width="14" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                    <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393 c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393 s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                </svg>
            </div>
        </div>
    </div>
@endsection