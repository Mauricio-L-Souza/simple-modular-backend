<?php

namespace Core\Auth\Enums;

enum UserAccessEnum: string
{
    case SHOW_USERS = 'users.show';
    case CREATE_USERS = 'users.store';

    case SHOW_CUSTOMERS = 'customers.show';
    case CREATE_CUSTOMERS = 'customers.store';
    case UPDATE_CUSTOMERS = 'customers.update';
    case DELETE_CUSTOMERS = 'customers.delete';

    case INDEX_FAVORITES = 'favorites.index';
    case SHOW_FAVORITES = 'favorites.show';
    case CREATE_FAVORITES = 'favorites.store';
    case UPDATE_FAVORITES = 'favorites.update';
    case DELETE_FAVORITES = 'favorites.delete';

    case CREATE_PRODUCTS = 'products.index';
    case UPDATE_PRODUCTS = 'products.show';
}

