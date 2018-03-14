@isset($survey)
<div class = "survey_container" data-id = "{{ $survey->id }}">
    <h1 class = "survey_id" >{{ $survey->name }}</h1>
        <form method="post" action = "">
        {{ csrf_field() }}
            @foreach($answers as $answer)
                <label class = "survey_answer__single">
                
                <input type = "radio" class = "survey_answer__radio" style = "  -webkit-appearance: radio;width:auto; " data-id = "{{ $answer->id }}"" value = "{{ $answer->id }}"/>
                {{ $answer->answer_text }}
                </label></br>
            @endforeach
        </form>
</div>
@endisset
