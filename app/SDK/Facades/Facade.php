<?php

namespace SDK\Facades;

abstract class Facade
{
    /**
     * Приложение.
     */
    protected static $app;

    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * Получаем корневой объект фасада над которым будут выполняться операции.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Получаем имя нужного нам объекта. Переопределяется в каждом Фасаде.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    /**
     * Получаем нужный объект данного фасада из контейнера.
     *
     * @param  string|object $name
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }
        return new static::$app->aliases[$name];
    }

    /**
     * Задаем экземпляр приложения.
     *
     * @param  mixed
     * @return void
     */
    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }

    /**
     * Вызов нужной функции при статическом несуществующем методе
     *
     * @param  string $method
     * @param  array $args
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new RuntimeException('Такого фассада нет в контейнере!');
        }

        return $instance->$method(...$args);
    }
}