
{{ form("products/save", 'role': 'form') }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("Actores", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Guardar", "class": "btn btn-success") }}
        </li>
    </ul>

    {{ content() }}

    <h2>Editar Actor</h2>

    <fieldset>

        {% for element in form %}
            {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                {{ element }}
            {% else %}
                <div class="form-group">
                    {{ element.label() }}
                    {{ element.render(['class': 'form-control']) }}
                </div>
            {% endif %}
        {% endfor %}

    </fieldset>

</form>
