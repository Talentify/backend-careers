<?php

/**
 * @apiGroup vacancies
 */
/**
 * Serviço Schole
 *
 * @api {get} /api/vacancies Lista Todos
 * @apiVersion 0.0.1
 * @apiName vacanciesReadAll
 * @apiGroup vacancies
 * @apiPermission nenhuma
 *
 * @apiDescription Usado para listar todos os vacancies.
 *
 * @apiSuccess {String} success Status da api.
 * @apiSuccess {Array} data Dados da requisição.
 * @apiSuccess {String} message Mensagem de retorno.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "success": true,
 *          "data": [],
 *          "message": "Registros recuperados com sucesso."
 *     }
 *
 * @apiError InternalError Erro interno.
 *
 * @apiErrorExample InternalError:
 *    HTTP/1.1 500 Internal Server Error
 *
 * @apiSampleRequest /api/vacancies
 */
/**
 * @api {get} /api/vacancies/:id Lista
 * @apiVersion 0.0.1
 * @apiName vacanciesRead
 * @apiGroup vacancies
 * @apiPermission nenhuma
 *
 * @apiDescription Usado para listar uma vacancies.
 *
 * @apiParam {Number} id Id da vacancies.
 *
 * @apiSuccess {String} success Status da api.
 * @apiSuccess {Array} data Dados da requisição.
 * @apiSuccess {String} message Mensagem de retorno.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "success": true,
 *          "data": [],
 *          "message": "Registros recuperados com sucesso."
 *     }
 *
 * @apiError InternalError Erro interno.
 *
 * @apiErrorExample InternalError:
 *    HTTP/1.1 500 Internal Server Error
 *
 * @apiSampleRequest /api/vacancies/:id
 */
/**
 * @api {post} /api/vacancies Criar
 * @apiVersion 0.0.1
 * @apiName vacanciesCreate
 * @apiGroup vacancies
 * @apiPermission nenhuma
 *
 * @apiDescription Usado para criar um novo vacancies.
 *
 * @apiParam {String} title Título.
 * @apiParam {String} description Descrição.
 * @apiParam {String} status Status.
 * @apiParam {String} [workplace] Local de trabalho.
 * @apiParam {String} [salary] Sálario.
 *
 * @apiSuccess {String} success Status da api.
 * @apiSuccess {Array} data Dados da requisição.
 * @apiSuccess {String} message Mensagem de retorno.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "success": true,
 *          "data": [],
 *          "message": "Registro criado com sucesso."
 *     }
 *
 * @apiError InternalError Erro interno.
 *
 * @apiErrorExample InternalError:
 *    HTTP/1.1 500 Internal Server Error
 *
 * @apiSampleRequest /api/vacancies
 */
/**
 * @api {put} /api/vacancies/:id Editar
 * @apiVersion 0.0.1
 * @apiName vacanciesUpdate
 * @apiGroup vacancies
 * @apiPermission nenhuma
 *
 * @apiParam {Number} id Id da vacancies.
 * @apiParam {String} title Título.
 * @apiParam {String} description Descrição.
 * @apiParam {String} status Status.
 * @apiParam {String} [workplace] Local de trabalho.
 * @apiParam {String} [salary] Sálario.
 *
 * @apiSuccess {String} success Status da api.
 * @apiSuccess {Array} data Dados da requisição.
 * @apiSuccess {String} message Mensagem de retorno.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "success": true,
 *          "data": [],
 *          "message": "Registros editado com sucesso."
 *     }
 *
 * @apiError InternalError Erro interno.
 *
 * @apiErrorExample InternalError:
 *    HTTP/1.1 500 Internal Server Error
 *
 * @apiSampleRequest /api/vacancies/:id
 */
/**
 * @api {delete} /api/vacancies/:id Remove
 * @apiVersion 0.0.1
 * @apiName vacanciesDelete
 * @apiGroup vacancies
 * @apiPermission nenhuma
 *
 * @apiDescription Usado para Remover uma vacancies.
 *
 * @apiParam {Number} id Id da vacancies.
 *
 * @apiSuccess {String} success Status da api.
 * @apiSuccess {Array} data Dados da requisição.
 * @apiSuccess {String} message Mensagem de retorno.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "success": true,
 *          "data": [],
 *          "message": "Registros editado com sucesso."
 *     }
 *
 * @apiError InternalError Erro interno.
 *
 * @apiErrorExample InternalError:
 *    HTTP/1.1 500 Internal Server Error
 *
 * @apiSampleRequest /api/vacancies/:id
 */
 Route::apiResource('vacancies', 'API\VacancyController');
