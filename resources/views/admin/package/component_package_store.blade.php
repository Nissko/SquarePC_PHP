<div class="fs-5 fw-bold">Комплектующие готовой конфигурации:</div>
{{--Комлектующие конфигурации--}}
<div>
    {{--CPU--}}
    <container>
        <label for="cpu" class="form-label">Процессор:</label>
        <select id="cpu" class="form-select mb-3" name="cpu_id">
            <option selected disabled>Выберите процессор</option>
            @foreach($cpus as $cpu)
                <option value="{{ $cpu -> id }}">{{ $cpu -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    {{--MOTHERBOARD--}}
    <container>
        <label for="cpu" class="form-label">Материнская плата:</label>
        <select id="cpu" class="form-select mb-3" name="motherboard_id">
            <option selected disabled>Выберите материнскую плату</option>
            @foreach($motherboards as $motherboard)
                <option value="{{ $motherboard -> id }}">{{ $motherboard -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    {{--RAM--}}
    <container>
        <label for="cpu" class="form-label">Оперативная память:</label>
        <select id="cpu" class="form-select mb-3" name="ram_id">
            <option selected disabled>Выберите оперативную память</option>
            @foreach($rams as $ram)
                <option value="{{ $ram -> id }}">{{ $ram -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    {{--GPU--}}
    <container>
        <label for="cpu" class="form-label">Видеокарта:</label>
        <select id="cpu" class="form-select mb-3" name="gpu_id">
            <option selected disabled>Выберите видеокарту</option>
            @foreach($gpus as $gpu)
                <option value="{{ $gpu -> id }}">{{ $gpu -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    {{--PSU--}}
    <container>
        <label for="cpu" class="form-label">Блок питания:</label>
        <select id="cpu" class="form-select mb-3" name="psu_id">
            <option selected disabled>Выберите блок питания:</option>
            @foreach($psus as $psu)
                <option value="{{ $psu -> id }}">{{ $psu -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    {{--HDD--}}
    <container>
        <label for="cpu" class="form-label">Жесткий диск:</label>
        <select id="cpu" class="form-select mb-3" name="disk_id">
            <option selected disabled>Выберите диск</option>
            @foreach($disks as $disk)
                @if($disk -> type === "HDD")
                    <option value="{{ $disk -> id }}">{{ $disk -> name }}</option>
                @endif
            @endforeach
        </select>
    </container>
    {{----}}

    {{--SSD--}}
    <container>
        <label for="cpu" class="form-label">Твердотельный накопитель:</label>
        <select id="cpu" class="form-select mb-3" name="ssd_id">
            <option selected disabled>Выберите накопитель</option>
            @foreach($disks as $disk)
                @if($disk -> type === "SSD")
                    <option value="{{ $disk -> id }}">{{ $disk -> name }}</option>
                @endif
            @endforeach
        </select>
    </container>
    {{----}}

    {{--COOLING--}}
    <container>
        <label for="cpu" class="form-label">Охлаждение:</label>
        <select id="cpu" class="form-select mb-3" name="cooling_id">
            <option selected disabled>Выберите систему охлаждения</option>
            @foreach($coolings as $cooling)
                <option value="{{ $cooling -> id }}">{{ $cooling -> name }}</option>
            @endforeach
        </select>
    </container>
    {{----}}

    @foreach($cases as $case)
        <div class="form-label">{{ $case -> name }}</div>
        <input type="hidden" name="case_id" value="{{ $case -> id }}">
    @endforeach
</div>
{{----}}
