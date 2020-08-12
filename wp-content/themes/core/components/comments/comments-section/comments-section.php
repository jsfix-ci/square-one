{% if post_password_required == false %}

<div id="comments" class="comments" data-js="comment-form">

    {% if have_comments %}

    <h6 class="comments__title h4">{{ title }}</h6>

    <ol class="comments__list">
        {{ comments }}
    </ol>

    {% if pagination.paged %}

    <nav class="pagination pagination--comments" aria-labelledby="pagination__label-comments">

        <h3 id="pagination__label-comments" class="u-visually-hidden">{{ __('Comments Pagination') }}</h3>

        <ol class="pagination__list">

            {% if pagination.previous %}
            <li class="pagination__item pagination__item--previous">
                {{ pagination.previous }}
            </li>
            {% endif %}

            {% if pagination.next %}
            <li class="pagination__item pagination__item--next">
                {{ pagination.next }}
            </li>
            {% endif %}

        </ol>

    </nav>

    {% endif %}

    {% if open == false %}
    <p class="comments__none">{{ __( 'Comments are closed.' )|esc_html }}</p>
    {% endif %}

    {% endif %}

    {{ form }}

</div>

{% endif %}
